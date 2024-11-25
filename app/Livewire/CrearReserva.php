<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Habitacion;
use App\Models\Huesped;
use App\Models\Reservas;

class CrearReserva extends Component
{
    public $habitacion_id;
    public $check_in;
    public $check_out;
    public $huesped_id;
    public $estado = 'pendiente';
    public $observaciones;

    // Propiedades computadas para las listas
    public function getHabitacionesDisponiblesProperty()
    {
        return Habitacion::where('disponibilidad', 'disponible')->get();
    }

    public function getHuespedesProperty()
    {
        return Huesped::all();
    }

    public function guardarReserva()
    {
        // Validaciones
        $this->validate([
            'habitacion_id' => 'required',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'huesped_id' => 'required',
            'estado' => 'required|in:pendiente,confirmada',
            'observaciones' => 'nullable|string|max:255'
        ], [
            'habitacion_id.required' => 'Debe seleccionar una habitación.',
            'check_in.required' => 'La fecha de check-in es obligatoria.',
            'check_in.date' => 'El formato de fecha de check-in no es válido.',
            'check_out.required' => 'La fecha de check-out es obligatoria.',
            'check_out.date' => 'El formato de fecha de check-out no es válido.',
            'check_out.after' => 'La fecha de check-out debe ser posterior al check-in.',
            'huesped_id.required' => 'Debe seleccionar un huésped.',
            'estado.required' => 'El estado es obligatorio.',
            'estado.in' => 'El estado seleccionado no es válido.'
        ]);

        try {
            // Crear la reserva
            $reserva = Reservas::create([
                'habitacion_id' => $this->habitacion_id,
                'check_in' => $this->check_in,
                'check_out' => $this->check_out,
                'huesped_id' => $this->huesped_id,
                'estado' => $this->estado,
                'observaciones' => $this->observaciones
            ]);

            // Actualizar el estado de la habitación a 'reservada'
            $habitacion = Habitacion::find($this->habitacion_id);
            $habitacion->update(['disponibilidad' => 'reservada']);

            // Mensaje de éxito
            session()->flash('message', 'Reserva creada exitosamente.');

            // Redireccionar a la vista de recepción
            return redirect()->route('recepcion');

        } catch (\Exception $e) {
            session()->flash('error', 'Error al crear la reserva. Por favor, intente nuevamente.');
        }
    }

    public function render()
    {
        return view('livewire.crear-reserva', [
            'habitacionesDisponibles' => $this->habitacionesDisponibles,
            'huespedes' => $this->huespedes
        ]);
    }
}
