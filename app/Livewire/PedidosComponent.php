<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pedidos;

class PedidosComponent extends Component
{

    public $viewMode = 'list';

    public $pedidos, $detallePedido = [], $productos, $proveedores;

    public $pedidoId, $proveedorId, $fechaEntrega, $estado, $total;
    public $productosSeleccionados = []; // Para crear pedidos.

    public function cambiarVista($vista)
    {
        $this->viewMode = $vista;
    }

    public function render()
    {
        $this->pedidos = Pedidos::all();
        return view('livewire.pedidos-component')->layout('layouts.app');
    }

}
