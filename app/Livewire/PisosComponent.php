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
            'numeroPiso' => 'required|integer',
            'descripcion' => 'nullable|string',
        ]);
        
        Piso::create([
            'numero_piso' => $this->numeroPiso,
            'descripcion' => $this->descripcion,
        ]);

        session()->flash('message', 'Piso de establecimiento creado con éxito.');
        $this->cerrarModalCrear();
    }

    // Abrir y cerrar modales de edición
    public function abrirModalEditar($id)
    {
        $this->resetearCampos();
        $this->pisoId = $id;
        $this->cargarDatosTipo($id);
        $this->isEditModalOpen = true;
    }

    public function cerrarModalEditar()
    {
        $this->resetearCampos();
        $this->isEditModalOpen = false;
    }

    // Cargar los datos del piso del establecimiento para editar
    private function cargarDatosTipo($id)
    {
        $piso = Piso::findOrFail($id);
        $this->numeroPiso = $piso->numero_piso;
        $this->descripcion = $piso->descripcion;
    }

    // Actualizar tipo de habitación existente
    public function actualizar()
    {
        $this->validate([
            'numeroPiso' => 'required|integer',
            'descripcion' => 'nullable|string',
        ]);        

        Piso::find($this->pisoId)->update([
            'numero_piso' => $this->numeroPiso,
            'descripcion' => $this->descripcion,
        ]);

        session()->flash('message', 'Piso del establecimiento actualizado con éxito.');
        $this->cerrarModalEditar();
    }

    // Eliminar tipo de habitación
    public function eliminar($id)
    {
        Piso::find($id)->delete();
        session()->flash('message', 'Piso del establecimiento eliminado con éxito.');
    }
}
