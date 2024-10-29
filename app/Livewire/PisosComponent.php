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
        $this->tipoId = null;
        $this->numeroPiso = '';
        $this->descripcion = '';
    }

    public function almacenar()
    {
        $this->validate([
            'numeroPiso' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        Piso::create([
            'numero_piso' => $this->numeroPiso,
            'descripcion' => $this->descripcion,
        ]);

        session()->flash('message', 'Piso de establecimiento creado con éxito.');
        $this->cerrarModalCrear();
    }
}
