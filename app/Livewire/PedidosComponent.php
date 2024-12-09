<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pedidos;
use App\Models\Proveedores;
use App\Models\Productos;
use App\Models\DetallePedido;
use Illuminate\Support\Facades\DB;

class PedidosComponent extends Component
{
    public $viewMode = 'list';
    public $proveedores, $productos, $pedidos;
    public $cantidad = []; // Cantidades específicas para cada producto
    public $productosSeleccionados = []; // Productos seleccionados en el pedido
    public $proveedorSeleccionado; // Proveedor seleccionado en el formulario
    public $isDetalleModalOpen = false;
    public $pedidoSeleccionado;

    public function mount()
    {
        $this->proveedores = Proveedores::all();
        $this->productos = Productos::all();
        $this->pedidos = Pedidos::obtenerPedidosConRelaciones();
    }

    public function cambiarVista($vista)
    {
        $this->viewMode = $vista;
    }

    public function render()
    {
        $this->pedidos = Pedidos::all();
        return view('livewire.pedidos-component')->layout('layouts.app');
    }

    public function agregarProducto($productoId)
    {
        $cantidad = $this->cantidad[$productoId] ?? 1;

        if (isset($this->productosSeleccionados[$productoId])) {
            // Aumentar la cantidad
            $this->productosSeleccionados[$productoId]['cantidad'] += $cantidad;
            // Actualizar el subtotal
            $this->productosSeleccionados[$productoId]['subtotal'] =
                $this->productosSeleccionados[$productoId]['precio'] * $this->productosSeleccionados[$productoId]['cantidad'];
        } else {
            $producto = $this->productos->find($productoId);
            if ($producto) {
                $this->productosSeleccionados[$productoId] = [
                    'id' => $producto->id,
                    'nombre' => $producto->nombre,
                    'precio' => $producto->precio,
                    'cantidad' => $cantidad,
                    'subtotal' => $producto->precio * $cantidad,
                ];
            }
        }
        // Reiniciar la cantidad después de agregar
        $this->cantidad[$productoId] = 1;
    }

    public function eliminarProducto($productoId)
    {
        unset($this->productosSeleccionados[$productoId]);
    }

    public function registrarPedido()
    {
        $this->validate([
            'proveedorSeleccionado' => 'required|exists:proveedores,id',
            'productosSeleccionados' => 'required|array|min:1',
            'productosSeleccionados.*.id' => 'exists:productos,id',
            'productosSeleccionados.*.cantidad' => 'required|integer|min:1',
        ], [
            'proveedorSeleccionado.required' => 'Debe seleccionar un proveedor.',
            'proveedorSeleccionado.exists' => 'El proveedor seleccionado no es válido.',
            'productosSeleccionados.required' => 'Debe seleccionar al menos un producto.',
            'productosSeleccionados.array' => 'Los productos seleccionados deben ser un arreglo.',
            'productosSeleccionados.min' => 'Debe seleccionar al menos un producto.',
            'productosSeleccionados.*.id.exists' => 'El producto seleccionado no es válido.',
            'productosSeleccionados.*.cantidad.required' => 'La cantidad es obligatoria para cada producto.',
            'productosSeleccionados.*.cantidad.integer' => 'La cantidad debe ser un número entero.',
            'productosSeleccionados.*.cantidad.min' => 'La cantidad debe ser al menos 1.'
        ]);

        try {
            DB::beginTransaction();

            $total = collect($this->productosSeleccionados)->sum(fn($producto) => $producto['cantidad'] * $producto['precio']);

            // Crear el pedido
            $pedido = Pedidos::create([
                'proveedor_id' => $this->proveedorSeleccionado,
                'estado_pedido' => 'Pendiente',
                'total' => $total,
                'fecha_entrega' => null, // Campo para manejar después, cuando se cambie a entregado
            ]);

            // Crear los detalles del pedido
            foreach ($this->productosSeleccionados as $producto) {
                DetallePedido::create([
                    'pedido_id' => $pedido->id,
                    'producto_id' => $producto['id'],
                    'cantidad' => $producto['cantidad'],
                    'precio_unitario' => $producto['precio'],
                    'subtotal' => $producto['cantidad'] * $producto['precio'],
                ]);
            }

            DB::commit();

            // Resetear el formulario y notificar
            $this->reset(['proveedorSeleccionado', 'productosSeleccionados', 'cantidad']);
            session()->flash('message', 'Pedido registrado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('message', 'Error al registrar el pedido. Por favor, intenta de nuevo.');
        }
    }

    public function cancelar($pedidoId)
    {
        $pedido = Pedidos::find($pedidoId);
        if ($pedido) {
            $pedido->estado_pedido = 'Cancelado';
            $pedido->save();
            
            session()->flash('message', 'Pedido cancelado exitosamente.');
        }
    }

    public function check($pedidoId)
    {
        try {
            DB::beginTransaction(); // Inicia la transacción

            $pedido = Pedidos::find($pedidoId);
            if (!$pedido) {
                throw new \Exception('Pedido no encontrado');
            }

            // Actualiza el pedido
            $pedido->estado_pedido = 'Entregado';
            $pedido->fecha_entrega = now();
            $pedido->save();

            // Actualiza el stock de productos
            foreach($pedido->detalles as $detalle) {
                $producto = Productos::find($detalle->producto_id);
                if (!$producto) {
                    throw new \Exception('Producto no encontrado');
                }
                $producto->stock += $detalle->cantidad;
                $producto->save();
            }

            DB::commit(); // Confirma todas las operaciones
            session()->flash('message', 'Pedido marcado como entregado exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack(); // Revierte todas las operaciones si hay error
            session()->flash('error', 'Error al procesar el pedido: ' . $e->getMessage());
        }
    }

    
    public function verDetalles($pedidoId)
    {
        $this->pedidoSeleccionado = Pedidos::with(['proveedor', 'detalles.producto'])
            ->findOrFail($pedidoId);
        $this->isDetalleModalOpen = true;
    }

    public function cerrarModalDetalle()
    {
        $this->isDetalleModalOpen = false;
        $this->pedidoSeleccionado = null;
    }
}
