<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pedidos;
use App\Models\Proveedores;
use App\Models\Productos;
use App\Models\DetallePedido;

class PedidosComponent extends Component
{

    public $viewMode = 'list';

    public $pedidos, $detallePedido = [], $proveedores;
    public $cantidad = [];

    public $pedidoId, $proveedorId, $fechaEntrega, $estado, $total;
    
    public $productos = []; // Para almacenar los productos disponibles
    public $productosSeleccionados = []; // Para almacenar los productos seleccionados en el pedido

    public function cambiarVista($vista)
    {
        $this->viewMode = $vista;
    }

    // Método para inicializar los datos
    public function mount()
    {
        // Puedes cargar los proveedores y productos aquí si los necesitas
        $this->proveedores = Proveedores::all();
        $this->productos = Productos::all();

        // Usamos el método del modelo para obtener los pedidos con sus relaciones
        $this->pedidos = Pedidos::obtenerPedidosConRelaciones();
    }

    public function render()
    {
        $this->pedidos = Pedidos::all();
        return view('livewire.pedidos-component')->layout('layouts.app');
    }


    public function agregarProducto($productoId)
    {
        $cantidad = $this->cantidad[$productoId] ?? 1;

        if (array_key_exists($productoId, $this->productosSeleccionados)) {
            // Aumentar la cantidad
            $this->productosSeleccionados[$productoId]['cantidad'] += $cantidad;
            
            // Actualizar el subtotal con la nueva cantidad
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
                    'subtotal' => $producto->precio * $cantidad,  // Multiplicamos precio por cantidad
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


    // Partes a utilizar mas tarde
    // public $pedidoSeleccionado;

    // public function verDetalle($id)
    // {
    //     $this->pedidoSeleccionado = Pedido::with('detallePedido.producto', 'proveedor')->find($id);
    // }



    // public $productosSeleccionados = [];
    // public $resumenPedido = [];
    // public $totalPedido = 0.00;

    // public function agregarProducto($id)
    // {
    //     $producto = Producto::find($id);
    //     if ($producto) {
    //         $this->resumenPedido[] = [
    //             'id' => $producto->id,
    //             'nombre' => $producto->nombre,
    //             'precio' => $producto->precio,
    //             'cantidad' => 1,
    //             'subtotal' => $producto->precio,
    //         ];
    //         $this->actualizarTotal();
    //     }
    // }

    // public function actualizarTotal()
    // {
    //     $this->totalPedido = array_sum(array_column($this->resumenPedido, 'subtotal'));
    // }

    // public function eliminarProducto($index)
    // {
    //     unset($this->resumenPedido[$index]);
    //     $this->resumenPedido = array_values($this->resumenPedido); // Reindexar el array
    //     $this->actualizarTotal();
    // }

}
