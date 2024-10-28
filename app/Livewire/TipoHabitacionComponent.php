<?php

namespace App\Livewire;

use App\Models\TipoHabitacion; // Asegúrate de que el modelo está importado
use Livewire\Component;

class TipoHabitacionComponent extends Component
{
    public $tipos, $tipoId, $nombreTipo, $descripcion;
    public $isCreateModalOpen = 0;
    public $isEditModalOpen = 0;

    // Renderizar todos los tipos de habitación
    public function render()
    {
        $this->tipos = TipoHabitacion::all();
        return view('livewire.tipo-habitacion-component')->layout('layouts.app');
    }

    // Abrir y cerrar modales de creación
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

    // Abrir y cerrar modales de edición
    public function abrirModalEditar($id)
    {
        $this->resetearCampos();
        $this->tipoId = $id;
        $this->cargarDatosTipo($id);
        $this->isEditModalOpen = true;
    }

    public function cerrarModalEditar()
    {
        $this->resetearCampos();
        $this->isEditModalOpen = false;
    }

    // Cargar los datos del tipo de habitación para editar
    private function cargarDatosTipo($id)
    {
        $tipo = TipoHabitacion::findOrFail($id);
        $this->nombreTipo = $tipo->nombre_tipo;
        $this->descripcion = $tipo->descripcion;
    }

    // Reseteo de campos
    private function resetearCampos()
    {
        $this->tipoId = null;
        $this->nombreTipo = '';
        $this->descripcion = '';
    }

    // Guardar un nuevo tipo de habitación
    public function almacenar()
    {
        $this->validate([
            'nombreTipo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        TipoHabitacion::create([
            'nombre_tipo' => $this->nombreTipo,
            'descripcion' => $this->descripcion,
        ]);

        session()->flash('message', 'Tipo de habitación creado con éxito.');
        $this->cerrarModalCrear();
    }

    // Actualizar tipo de habitación existente
    public function actualizar()
    {
        $this->validate([
            'nombreTipo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        TipoHabitacion::find($this->tipoId)->update([
            'nombre_tipo' => $this->nombreTipo,
            'descripcion' => $this->descripcion,
        ]);

        session()->flash('message', 'Tipo de habitación actualizado con éxito.');
        $this->cerrarModalEditar();
    }

    // Eliminar tipo de habitación
    public function eliminar($id)
    {
        TipoHabitacion::find($id)->delete();
        session()->flash('message', 'Tipo de habitación eliminada con éxito.');
    }
}

?>
