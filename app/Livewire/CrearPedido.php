<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pedidos;
use App\Models\Proveedores;
use App\Models\Productos;
use App\Models\DetallePedido;
use Illuminate\Support\Facades\DB;

class CrearPedido extends Component
{
    public $proveedores, $productos, $cantidad = [];
    public $productosSeleccionados = [];
    public $proveedorSeleccionado;

    public function mount()
    {
        $this->proveedores = Proveedores::all();
        $this->productos = Productos::all();
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

    public function render()
    {
        return view('livewire.crear-pedido');
    }
}