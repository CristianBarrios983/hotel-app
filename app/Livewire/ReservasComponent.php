<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Reservas;

class ReservasComponent extends Component
{

    public $isCreateModalOpen = 0;
    public $isEditModalOpen = 0;

    public function render()
    {
        $reservas = Reservas::with(['habitacion', 'huesped'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.reservas-component', [
            'reservas' => $reservas
        ])->layout('layouts.app');
    }

    public function confirmarReserva($id)
    {
        try {
            $reserva = Reservas::find($id);
            
            if (!$reserva) {
                session()->flash('error', 'Reserva no encontrada.');
                return;
            }

            // Actualizar el estado de la reserva
            $reserva->update([
                'estado' => 'confirmada'
            ]);

            // Actualizar el estado de la habitación si es necesario
            $reserva->habitacion->update([
                'disponibilidad' => 'reservada'
            ]);

            session()->flash('message', 'Reserva confirmada exitosamente.');

        } catch (\Exception $e) {
            session()->flash('error', 'Error al confirmar la reserva. Por favor, intente nuevamente.');
        }
    }

    public function marcarNoShow($id)
    {
        try {
            $reserva = Reservas::find($id);
            
            if (!$reserva) {
                session()->flash('error', 'Reserva no encontrada.');
                return;
            }

            // Actualizar el estado de la reserva
            $reserva->update([
                'estado' => 'no_show'
            ]);

            // Actualizar el estado de la habitación si es necesario
            $reserva->habitacion->update([
                'disponibilidad' => 'disponible'
            ]);

            session()->flash('message', 'Reserva marcada como No Show exitosamente.');

        } catch (\Exception $e) {
            session()->flash('error', 'Error al marcar la reserva como No Show. Por favor, intente nuevamente.');
        }
    }
}
