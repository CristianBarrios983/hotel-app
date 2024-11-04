<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Categorias;

class CategoriasComponent extends Component
{

    public $categorias;

    public $isCreateModalOpen = 0;
    public $isEditModalOpen = 0;

    public function render()
    {
        $this->categorias = Categorias::all();
        return view('livewire.categorias-component')->layout('layouts.app');
    }
}
