<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Reservas;

class CheckInComponent extends Component
{
    public $isModalOpen = false;
    public $reservaSeleccionada;
    public $identidadVerificada = false;
    public $observaciones;

    public function render()
    {
        $hoy = now()->format('Y-m-d');
        
        $reservas = Reservas::with(['habitacion', 'huesped'])
            ->where('estado', 'confirmada')
            ->whereDate('check_in', $hoy)
            ->get();

        return view('livewire.check-in-component', [
            'reservas' => $reservas
        ]);
    }

    public function confirmarCheckIn()
    {
        // Validar que se haya verificado la identidad
        $this->validate([
            'identidadVerificada' => 'required|accepted',
            'observaciones' => 'nullable|string|max:255'
        ], [
            'identidadVerificada.accepted' => 'Debe verificar la identidad del huésped antes de continuar.'
        ]);

        try {
            if (!$this->reservaSeleccionada) {
                session()->flash('error', 'Reserva no encontrada.');
                return;
            }

            // Actualizar el estado de la reserva
            $this->reservaSeleccionada->update([
                'estado' => 'check_in',
                'observaciones' => $this->observaciones
            ]);

            // Actualizar el estado de la habitación
            $this->reservaSeleccionada->habitacion->update([
                'disponibilidad' => 'ocupada'
            ]);

            session()->flash('message', 'Check-in realizado exitosamente.');
            $this->cerrarModal();

        } catch (\Exception $e) {
            session()->flash('error', 'Error al realizar el check-in. Por favor, intente nuevamente.');
        }
    }

    public function seleccionarReserva($id)
    {
        $this->reservaSeleccionada = Reservas::find($id);
        $this->isModalOpen = true;
    }

    public function cerrarModal()
    {
        $this->isModalOpen = false;
        $this->reset(['reservaSeleccionada', 'identidadVerificada', 'observaciones']);
    }
}
