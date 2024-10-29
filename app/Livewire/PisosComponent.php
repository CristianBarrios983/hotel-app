<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Piso;

class PisosComponent extends Component
{

    public $pisos, $pisoId, $numeroPiso, $descripcion;
    public $isCreateModalOpen = 0;
    public $isEditModalOpen = 0;

    public function render()
    {
        $this->pisos = Piso::all();
        return view('livewire.pisos-component')->layout('layouts.app');
    }
}
