<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Mantenimiento;

class MantenimientoComponent extends Component
{

    public $mantenimientos;

    public $isCreateModalOpen = 0;
    public $isEditModalOpen = 0;

    public function render()
    {
        return view('livewire.mantenimiento-component');
    }

    public function abrirModalCrear()
    {
        // $this->resetearCampos();
        $this->isCreateModalOpen = true;
    }

    public function cerrarModalCrear()
    {
        // $this->resetearCampos();
        $this->isCreateModalOpen = false;
    }
}
