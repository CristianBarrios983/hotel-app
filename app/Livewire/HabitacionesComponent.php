<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Habitacion;
use App\Models\Piso;
use App\Models\TipoHabitacion;

class HabitacionesComponent extends Component
{

    public $tiposHabitacion = [];
    public $pisos = [];

    public $habitaciones, $habitacionId,$numeroHabitacion, $capacidad, $tamanio, $vistas, $tipo_cama, $precio, $tipo_habitacion_id, $piso_id;

    public $isCreateModalOpen = 0;
    public $isEditModalOpen = 0;


    public function mount()
    {
        // Obtenemos los tipos de habitación y pisos al cargar el componente
        $this->tiposHabitacion = TipoHabitacion::all();
        $this->pisos = Piso::all();
    }


    public function render()
    {
        $this->habitaciones = Habitacion::all();
        return view('livewire.habitaciones-component')->layout('layouts.app');
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

    public function resetearCampos()
    {
        $this->numeroHabitacion = '';
        $this->capacidad = '';
        $this->tamanio = '';
        $this->vistas = '';
        $this->tipo_cama = '';
        $this->precio = '';
        $this->tipo_habitacion_id = null;
        $this->piso_id = null;
    }

    public function almacenar()
    {
        $this->validate([
            'numeroHabitacion' => 'required|string|unique:habitaciones,numero_habitacion',
            'capacidad' => 'required|integer|min:1',
            'tamanio' => 'required|numeric|min:0.1',
            'vistas' => 'nullable|string',
            'tipo_cama' => 'required|string|in:Individual,Doble,Queen,King',
            'precio' => 'required|numeric|min:0',
            'tipo_habitacion_id' => 'required|exists:tipos_habitacion,id',
            'piso_id' => 'required|exists:pisos,id',
        ]);

        // Crear la nueva habitación en la base de datos
        Habitacion::create([
            'numero_habitacion' => $this->numeroHabitacion,
            'capacidad' => $this->capacidad,
            'tamano' => $this->tamanio,
            'vistas' => $this->vistas,
            'tipo_cama' => $this->tipo_cama,
            'precio_por_noche' => $this->precio,
            'tipo_habitacion_id' => $this->tipo_habitacion_id,
            'piso_id' => $this->piso_id,
        ]);

        // Mostrar mensaje de éxito
        session()->flash('message', 'Habitación creada con éxito.');

        // Cerrar el modal y resetear los campos
        $this->cerrarModalCrear();
    }

    // Abrir y cerrar modales de edición
    public function abrirModalEditar($id)
    {
        $this->resetearCampos();
        $this->habitacionId = $id;
        $this->cargarDatosHabitacion($id);
        $this->isEditModalOpen = true;
    }

    public function cerrarModalEditar()
    {
        $this->resetearCampos();
        $this->isEditModalOpen = false;
    }

    private function cargarDatosHabitacion($id) 
    {
        $habitacion = Habitacion::findOrFail($id);
        $this->numeroHabitacion = $habitacion->numero_habitacion;
        $this->capacidad = $habitacion->capacidad;
        $this->tamanio = $habitacion->tamano;
        $this->vistas = $habitacion->vistas;
        $this->tipo_cama = $habitacion->tipo_cama;
        $this->precio = $habitacion->precio_por_noche;
        $this->tipo_habitacion_id = $habitacion->tipo_habitacion_id;
        $this->piso_id = $habitacion->piso_id;
    }


    public function actualizar()
    {
        $this->validate([
            'numeroHabitacion' => 'required|string|unique:habitaciones,numero_habitacion,' . $this->habitacionId,
            'capacidad' => 'required|integer|min:1',
            'tamanio' => 'required|numeric|min:0.1',
            'vistas' => 'nullable|string',
            'tipo_cama' => 'required|string|in:Individual,Doble,Queen,King',
            'precio' => 'required|numeric|min:0',
            'tipo_habitacion_id' => 'required|exists:tipos_habitacion,id',
            'piso_id' => 'required|exists:pisos,id',
        ]);

        // Actualizar la habitación en la base de datos
        $habitacion = Habitacion::find($this->habitacionId);
        $habitacion->update([
            'numero_habitacion' => $this->numeroHabitacion,
            'capacidad' => $this->capacidad,
            'tamano' => $this->tamanio,
            'vistas' => $this->vistas,
            'tipo_cama' => $this->tipo_cama,
            'precio_por_noche' => $this->precio,
            'tipo_habitacion_id' => $this->tipo_habitacion_id,
            'piso_id' => $this->piso_id,
        ]);

        // Mostrar mensaje de éxito
        session()->flash('message', 'Habitación actualizada con éxito.');

        // Cerrar el modal y resetear los campos
        $this->cerrarModalEditar();
    }

    // Eliminar tipo de habitación
    public function eliminar($id)
    {
        Habitacion::find($id)->delete();
        session()->flash('message', 'Habitacion eliminado con éxito.');
    }


}
