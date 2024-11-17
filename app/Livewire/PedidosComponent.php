<?php

namespace App\Livewire;

use Livewire\Component;

class PedidosComponent extends Component
{

    public $viewMode = 'list';

    public $pedidos, $detallePedido = [], $productos, $proveedores;

    public $pedidoId, $proveedorId, $fechaPedido, $fechaEntrega, $estado, $total;
    public $productosSeleccionados = []; // Para crear pedidos.

    public function cambiarVista($vista)
    {
        $this->viewMode = $vista;
    }

    public function render()
    {
        return view('livewire.pedidos-component');
    }

}
