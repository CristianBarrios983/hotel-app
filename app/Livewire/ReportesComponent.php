<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Habitacion;
use App\Models\Factura;
use App\Models\Reservas;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Huesped;
use App\Models\Productos;
use App\Models\Servicios;

class ReportesComponent extends Component
{
    public $totalHabitaciones;
    public $habitacionesOcupadas;
    public $porcentajeOcupacion;
    public $ingresosMes;
    public $huéspedesFrecuentes;
    public $serviciosMasSolicitados;
    public $ocupacionDiaria;
    public $ingresosMensuales;
    public $procedenciaHuespedes;
    public $productosMasSolicitados;
    public $productosMasFrecuentes;
    public $totalServiciosFrecuentes;
    public $totalProductosFrecuentes;

    public function mount()
    {
        $this->totalHabitaciones = Habitacion::count();
        $this->habitacionesOcupadas = Habitacion::where('disponibilidad', 'ocupada')->count();
        $this->porcentajeOcupacion = ($this->habitacionesOcupadas / $this->totalHabitaciones) * 100;

        $hoy = Carbon::today();
        $inicioMes = Carbon::now()->startOfMonth();

        $this->ingresosMes = Factura::whereBetween('fecha_emision', [$inicioMes, $hoy])->sum('total');

        $this->huéspedesFrecuentes = Reservas::select('huesped_id')
            ->groupBy('huesped_id')
            ->havingRaw('COUNT(*) > 1')
            ->count();

        $this->totalProductosFrecuentes = Productos::select('nombre')
            ->join('detalle_facturas', 'productos.nombre', '=', 'detalle_facturas.concepto')
            ->groupBy('nombre')
            ->havingRaw('COUNT(detalle_facturas.concepto) > 1') 
            ->count(); 
        
        $this->totalServiciosFrecuentes = Servicios::select('nombre')
            ->join('detalle_facturas', 'servicios.nombre', '=', 'detalle_facturas.concepto')
            ->groupBy('nombre')
            ->havingRaw('COUNT(detalle_facturas.concepto) > 1') 
            ->count();

        $this->ocupacionDiaria = Habitacion::select(DB::raw('DATE(created_at) as fecha'), DB::raw('COUNT(*) as total'))
            ->where('disponibilidad', 'ocupada')
            ->groupBy('fecha')
            ->orderBy('fecha', 'asc')
            ->pluck('total', 'fecha');

        $this->ingresosMensuales = Factura::select(DB::raw('MONTH(fecha_emision) as mes'), DB::raw('SUM(total) as total'))
            ->groupBy('mes')
            ->orderBy('mes', 'asc')
            ->pluck('total', 'mes');

        $this->procedenciaHuespedes = Huesped::select('nacionalidad', DB::raw('COUNT(*) as total'))
            ->groupBy('nacionalidad')
            ->orderBy('total', 'desc')
            ->pluck('total', 'nacionalidad');

        $this->productosMasSolicitados = Productos::select('nombre', DB::raw('COUNT(detalle_facturas.concepto) as total'))
            ->join('detalle_facturas', 'productos.nombre', '=', 'detalle_facturas.concepto')
            ->groupBy('nombre')
            ->orderBy('total', 'desc')
            ->pluck('total', 'nombre');


        $this->serviciosMasSolicitados = Servicios::select('nombre', DB::raw('COUNT(detalle_facturas.concepto) as total'))
            ->join('detalle_facturas', 'servicios.nombre', '=', 'detalle_facturas.concepto')
            ->groupBy('nombre')
            ->orderBy('total', 'desc')
            ->pluck('total', 'nombre');
    }

    public function render()
    {
        return view('livewire.reportes-component');
    }
}
