<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Productos;
use App\Models\Categorias;

class ProductosComponent extends Component
{

    public $productos, $productoId, $nombreProducto, $descripcion, $precio, $stock, $stockMinimo, $categoria_id;

    public $categorias = [];

    public $isCreateModalOpen = 0;
    public $isEditModalOpen = 0;

    public function mount()
    {
        $this->categorias = Categorias::all();
    }

    public function render()
    {
        $this->productos = Productos::all();
        return view('livewire.productos-component')->layout('layouts.app');
    }

    public function abrirModalCrear()
    {
        $this->resetearCampos();
        $this->isCreateModalOpen = true;
    }

    public function cerrarModalCrear()
    {
        $this->resetearCampos();
        $this->isCreateModalOpen = false;
    }

    // Reseteo de campos
    private function resetearCampos()
    {
        $this->productoId = null;
        $this->nombreProducto = '';
        $this->descripcion = '';
        $this->precio = '';
        $this->stock = '';
        $this->stockMinimo = '';
        $this->categoria_id = null;
    }

    public function almacenar()
    {
        $this->validate([
            'nombreProducto' => 'required|string',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
            'stockMinimo' => 'required|numeric|min:0',
            'categoria_id' => 'required|exists:categorias,id',
        ]);        
        
        Productos::create([
            'nombre' => $this->nombreProducto,
            'descripcion' => $this->descripcion,
            'precio' => $this->precio,
            'stock' => $this->stock,
            'stock_minimo' => $this->stockMinimo,
            'categoria_id' => $this->categoria_id,
        ]);

        session()->flash('message', 'Producto creado con éxito.');
        $this->cerrarModalCrear();
    }
}
