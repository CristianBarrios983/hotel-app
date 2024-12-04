<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Habitacion;
use App\Models\Reservas;

class RecepcionComponent extends Component
{

    public $habitaciones = [];
    public $isModalOpen = false;
    public $habitacionSeleccionada;
    public $reservaActual;

    public function mount()
    {
        $this->habitaciones = Habitacion::all();
    }

    public function render()
    {
        return view('livewire.recepcion-component');
    }

    public function mostrarDetalles($habitacionId)
    {
        $this->habitacionSeleccionada = Habitacion::with('tipoHabitacion')->find($habitacionId);
        $this->reservaActual = Reservas::where('habitacion_id', $habitacionId)
            ->whereIn('estado', ['check_in', 'confirmada'])
            ->with(['huesped'])
            ->first();
        
        $this->isModalOpen = true;
    }

    public function cerrarModal()
    {
        $this->isModalOpen = false;
        $this->reset(['habitacionSeleccionada', 'reservaActual']);
    }
}
