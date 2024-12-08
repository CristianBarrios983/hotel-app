<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Mantenimiento;
use App\Models\Habitacion;

class MantenimientoComponent extends Component
{

    public $habitaciones = [];
    public $mantenimientos;
    public $mantenimientoId;
    public $habitacion_id, $descripcion, $personal, $prioridad, $estado;

    public $isCreateModalOpen = 0;
    public $isEditModalOpen = 0;

    public function mount()
    {
        $this->habitaciones = Habitacion::all();
    }

    public function render()
    {
        $this->mantenimientos = Mantenimiento::with('habitacion')->get();
        return view('livewire.mantenimiento-component', [
            'habitaciones' => Habitacion::all()
        ])->layout('layouts.app');
    }

    public function abrirModalCrear()
    {
        $this->resetearCampos();
        $this->isCreateModalOpen = true;
    }

    public function cerrarModalCrear()
    {
        $this->isCreateModalOpen = false;
        $this->resetearCampos();
    }

    public function resetearCampos()
    {
        $this->habitacion_id = null;
        $this->descripcion = '';
        $this->personal = '';
        $this->prioridad = '';
        $this->estado = 'pendiente';
    }

    public function registrarMantenimiento()
    {
        $this->validate([
            'habitacion_id' => 'required|exists:habitaciones,id',
            'descripcion' => 'required|string',
            'personal' => 'required|string',
            'prioridad' => 'required|in:alta,media,baja',
        ], [
            'habitacion_id.required' => 'Debe seleccionar una habitación.',
            'habitacion_id.exists' => 'La habitación seleccionada no es válida.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.string' => 'La descripción debe ser texto.',
            'personal.required' => 'El personal es obligatorio.',
            'personal.string' => 'El personal debe ser texto.',
            'prioridad.required' => 'La prioridad es obligatoria.',
            'prioridad.in' => 'La prioridad debe ser alta, media o baja.'
        ]);

        // Crear el nuevo mantenimiento en la base de datos
        Mantenimiento::create([
            'habitacion_id' => $this->habitacion_id,
            'descripcion' => $this->descripcion,
            'personal' => $this->personal,
            'prioridad' => $this->prioridad,
            'estado' => 'pendiente',  // Estado por defecto en minúsculas
        ]);

        // Actualizar el estado de la habitación a "En Mantenimiento"
        $habitacion = Habitacion::find($this->habitacion_id);
        $habitacion->update(['disponibilidad' => 'mantenimiento']);

        // Mostrar mensaje de éxito
        session()->flash('message', 'Mantenimiento registrado con éxito.');

        // Cerrar el modal y resetear los campos
        $this->cerrarModalCrear();
    }

    public function eliminar($id)
    {
        Mantenimiento::find($id)->delete();
        session()->flash('message', 'Mantenimiento eliminado con éxito.');
    }

    public function cambiarEstado($mantenimientoId, $nuevoEstado)
    {
        try {
            DB::beginTransaction();

            $mantenimiento = Mantenimiento::find($mantenimientoId);
            if (!$mantenimiento) {
                throw new \Exception('Mantenimiento no encontrado');
            }

            // Actualiza el estado del mantenimiento
            $mantenimiento->estado = $nuevoEstado;
            
            // Si el estado es "completado", actualizar fecha de completado y estado de habitación
            if ($nuevoEstado === 'completado') {
                $mantenimiento->fecha_completado = now();
                
                // Si hay una habitación asociada, actualizar su estado
                if ($mantenimiento->habitacion) {
                    $mantenimiento->habitacion->disponibilidad = 'disponible';
                    $mantenimiento->habitacion->save();
                }
            }
            
            $mantenimiento->save();

            DB::commit();
            session()->flash('message', 'Estado de mantenimiento actualizado exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Error al actualizar el estado: ' . $e->getMessage());
        }
    }

    public function abrirModalEditar($id)
    {
        $this->cargarDatosMantenimiento($id);
        $this->isEditModalOpen = true;
    }

    public function cerrarModalEditar()
    {
        $this->isEditModalOpen = false;
        $this->resetearCampos();
    }

    private function cargarDatosMantenimiento($id) 
    {
        $mantenimiento = Mantenimiento::findOrFail($id);
        $this->mantenimientoId = $mantenimiento->id;
        $this->habitacion_id = $mantenimiento->habitacion_id;
        $this->descripcion = $mantenimiento->descripcion;
        $this->personal = $mantenimiento->personal;
        $this->prioridad = $mantenimiento->prioridad;
    }

    public function actualizar()
    {
        $this->validate([
            'habitacion_id' => 'required|exists:habitaciones,id',
            'descripcion' => 'required|string',
            'personal' => 'required|string',
            'prioridad' => 'required|in:alta,media,baja',
        ], [
            'habitacion_id.required' => 'Debe seleccionar una habitación.',
            'habitacion_id.exists' => 'La habitación seleccionada no es válida.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.string' => 'La descripción debe ser texto.',
            'personal.required' => 'El personal es obligatorio.',
            'personal.string' => 'El personal debe ser texto.',
            'prioridad.required' => 'La prioridad es obligatoria.',
            'prioridad.in' => 'La prioridad debe ser alta, media o baja.'
        ]);

        // Actualizar el mantenimiento en la base de datos
        $mantenimiento = Mantenimiento::find($this->mantenimientoId);
        $mantenimiento->update([
            'habitacion_id' => $this->habitacion_id,
            'descripcion' => $this->descripcion,
            'personal' => $this->personal,
            'prioridad' => $this->prioridad,
        ]);

        // Mostrar mensaje de éxito
        session()->flash('message', 'Mantenimiento actualizado con éxito.');

        // Cerrar el modal y resetear los campos
        $this->cerrarModalEditar();
    }
}
