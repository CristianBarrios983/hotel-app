<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Habitacion;
use App\Models\Mantenimiento;
use App\Models\Reservas;
use App\Models\Factura;
use Carbon\Carbon;

class DashboardComponent extends Component
{

    public $totalHabitaciones;
    public $habitacionesOcupadas;
    public $porcentajeOcupacion;
    public $tareasPendientes;
    public $reservasRecientes;
    public $ingresosHoy;
    public $ingresosMes;

    public function mount(){

        $hoy = Carbon::today();
        $inicioMes = Carbon::now()->startOfMonth();

        $this->totalHabitaciones = Habitacion::count();
        $this->habitacionesOcupadas = Habitacion::where('disponibilidad', 'ocupada')->count();
        $this->porcentajeOcupacion = ($this->habitacionesOcupadas / $this->totalHabitaciones) * 100;
        $this->tareasPendientes = Mantenimiento::where('estado','pendiente')->get();
        $this->reservasRecientes = Reservas::with('huesped')
        ->whereIn('estado', ['pendiente', 'confirmada']) // Filtra por estado
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();

        $this->ingresosDia = Factura::whereDate('fecha_emision', $hoy)->sum('total');
    $this->ingresosMes = Factura::whereBetween('fecha_emision', [$inicioMes, $hoy])->sum('total');
    }

    public function render()
    {
        return view('livewire.dashboard-component');
    }
}
