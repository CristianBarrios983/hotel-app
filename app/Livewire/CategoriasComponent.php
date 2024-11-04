<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Categorias;

class CategoriasComponent extends Component
{

    public $categorias, $categoriaId, $nombreCategoria, $descripcion;

    public $isCreateModalOpen = 0;
    public $isEditModalOpen = 0;

    public function render()
    {
        $this->categorias = Categorias::all();
        return view('livewire.categorias-component')->layout('layouts.app');
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
        $this->categoriaId = null;
        $this->nombreCategoria = '';
        $this->descripcion = '';
    }

    public function almacenar()
    {
        $this->validate([
            'nombreCategoria' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);
        
        Categorias::create([
            'nombre_categoria' => $this->nombreCategoria,
            'descripcion' => $this->descripcion,
        ]);

        session()->flash('message', 'Categoria creada con éxito.');
        $this->cerrarModalCrear();
    }
}
