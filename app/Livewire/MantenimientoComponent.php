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
        $this->estado = 'Pendiente';
    }

    public function registrarMantenimiento()
    {
        $this->validate([
            'habitacion_id' => 'required|exists:habitaciones,id',
            'descripcion' => 'required|string',
            'personal' => 'required|string',
            'prioridad' => 'required|in:Alta,Media,Baja',
        ]);

        // Crear el nuevo mantenimiento en la base de datos
        Mantenimiento::create([
            'habitacion_id' => $this->habitacion_id,
            'descripcion' => $this->descripcion,
            'personal' => $this->personal,
            'prioridad' => $this->prioridad,
            'estado' => 'Pendiente',  // Estado por defecto
        ]);

        // Actualizar el estado de la habitación a "En Mantenimiento"
        $habitacion = Habitacion::find($this->habitacion_id);
        $habitacion->update(['disponibilidad' => 'en mantenimiento']);

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
            
            // Si el estado es "Completado", actualizar fecha de completado y estado de habitación
            if ($nuevoEstado === 'Completado') {
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
}
