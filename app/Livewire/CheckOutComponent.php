<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Reservas;

class CheckOutComponent extends Component
{
    public $isModalOpen = false;
    public $reservaSeleccionada;
    public $habitacionVerificada = false;

    public function render()
    {
        $hoy = now()->format('Y-m-d');
        
        $reservas = Reservas::with(['habitacion', 'huesped'])
            ->where('estado', 'check_in')
            ->whereDate('check_out', $hoy)
            ->get();

        return view('livewire.check-out-component', [
            'reservas' => $reservas
        ]);
    }

    public function iniciarCheckOut($id)
    {
        $this->reservaSeleccionada = Reservas::find($id);
        $this->isModalOpen = true;
    }

    public function cerrarModal()
    {
        $this->isModalOpen = false;
        $this->reset(['reservaSeleccionada', 'habitacionVerificada']);
    }

    public function procederAFacturacion()
    {
        if (!$this->habitacionVerificada) {
            session()->flash('error', 'Debe verificar la habitación antes de continuar.');
            return;
        }

        return redirect()->route('facturacion.crear', ['reserva' => $this->reservaSeleccionada->id]);
    }
}
