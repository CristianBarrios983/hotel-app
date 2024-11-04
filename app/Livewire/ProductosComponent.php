<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Productos;

class ProductosComponent extends Component
{

    public $productos, $productoId, $nombreProducto, $descripcion, $precio, $stock, $stockMinimo, $categoria;

    public function render()
    {
        $this->productos = Productos::all();
        return view('livewire.productos-component')->layout('layouts.app');
    }
}
