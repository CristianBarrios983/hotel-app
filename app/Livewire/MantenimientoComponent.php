<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Mantenimiento;
use App\Models\Habitacion;
use App\Models\User;

class MantenimientoComponent extends Component
{

    public $habitaciones = [];
    public $mantenimientos;
    public $mantenimientoId;
    public $habitacion_id, $descripcion, $personal_id, $prioridad, $estado;
    public $personalUsuarios = [];

    public $isCreateModalOpen = 0;
    public $isEditModalOpen = 0;

    public function mount()
    {
        $this->habitaciones = Habitacion::all();
        $this->personalUsuarios = User::role('mantenimiento')->get();
    }

    
    public function render()
{
    $user = auth()->user();

    // Filtrar los mantenimientos según el rol del usuario
    if ($user->hasRole('mantenimiento')) {
        // Solo mostrar mantenimientos asignados al usuario actual
        $this->mantenimientos = Mantenimiento::with(['habitacion', 'personal'])
            ->where('personal_id', $user->id)
            ->get();
    } else {
        // Mostrar todos los mantenimientos para otros roles (por ejemplo, admin)
        $this->mantenimientos = Mantenimiento::with(['habitacion', 'personal'])->get();
    }

    // Retornar la vista con los mantenimientos filtrados
    return view('livewire.mantenimiento-component', [
        'habitaciones' => Habitacion::all(),
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
        $this->personal_id = null;
        $this->prioridad = '';
        $this->estado = 'pendiente';
    }

    public function registrarMantenimiento()
    {
        $this->validate([
            'habitacion_id' => 'required|exists:habitaciones,id',
            'descripcion' => 'required|string',
            'personal_id' => 'required|exists:users,id',
            'prioridad' => 'required|in:alta,media,baja',
        ], [
            'habitacion_id.required' => 'Debe seleccionar una habitación.',
            'habitacion_id.exists' => 'La habitación seleccionada no es válida.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.string' => 'La descripción debe ser texto.',
            'personal_id.required' => 'El personal es obligatorio.',
            'personal_id.exists' => 'El personal seleccionado no es válido.',
            'prioridad.required' => 'La prioridad es obligatoria.',
            'prioridad.in' => 'La prioridad debe ser alta, media o baja.'
        ]);

        // Crear el nuevo mantenimiento en la base de datos
        Mantenimiento::create([
            'habitacion_id' => $this->habitacion_id,
            'descripcion' => $this->descripcion,
            'personal_id' => $this->personal_id,
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
        $this->personal_id = $mantenimiento->personal_id;
        $this->prioridad = $mantenimiento->prioridad;
    }

    public function actualizar()
    {
        $this->validate([
            'habitacion_id' => 'required|exists:habitaciones,id',
            'descripcion' => 'required|string',
            'personal_id' => 'required|exists:users,id',
            'prioridad' => 'required|in:alta,media,baja',
        ], [
            'habitacion_id.required' => 'Debe seleccionar una habitación.',
            'habitacion_id.exists' => 'La habitación seleccionada no es válida.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.string' => 'La descripción debe ser texto.',
            'personal_id.required' => 'El personal es obligatorio.',
            'personal_id.exists' => 'El personal seleccionado no es válido.',
            'prioridad.required' => 'La prioridad es obligatoria.',
            'prioridad.in' => 'La prioridad debe ser alta, media o baja.'
        ]);

        // Actualizar el mantenimiento en la base de datos
        $mantenimiento = Mantenimiento::find($this->mantenimientoId);
        $mantenimiento->update([
            'habitacion_id' => $this->habitacion_id,
            'descripcion' => $this->descripcion,
            'personal_id' => $this->personal_id,
            'prioridad' => $this->prioridad,
        ]);

        // Mostrar mensaje de éxito
        session()->flash('message', 'Mantenimiento actualizado con éxito.');

        // Cerrar el modal y resetear los campos
        $this->cerrarModalEditar();
    }
}
