<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Reservas;
use App\Models\Productos;
use App\Models\Servicios;
use App\Models\Factura;
use App\Models\User;
use App\Models\Mantenimiento;
use App\Models\Habitacion;
use Illuminate\Support\Facades\DB;

class FacturacionComponent extends Component
{
    public $reserva;
    public $detalles = [];
    public $metodo_pago;
    public $total = 0;
    public $showProductModal = false;
    public $productos;
    public $search = '';
    public $tipoSeleccionado = 'productos';
    public $items = [];

    public function mount($reserva)
    {
        $this->reserva = Reservas::with(['habitacion.tipoHabitacion', 'huesped'])
            ->findOrFail($reserva);

        // Agregamos el cargo inicial por la habitación
        $this->detalles[] = [
            'concepto' => 'Habitación ' . $this->reserva->habitacion->numero_habitacion,
            'cantidad' => $this->reserva->noches,
            'precio_unitario' => $this->reserva->habitacion->precio_por_noche,
            'subtotal' => $this->reserva->noches * $this->reserva->habitacion->precio_por_noche
        ];

        $this->calcularTotal();
        $this->cargarItems();
    }

    public function calcularTotal()
    {
        $this->total = collect($this->detalles)->sum('subtotal');
    }

    public function agregarCargo()
    {
        $this->detalles[] = [
            'concepto' => '',
            'cantidad' => 1,
            'precio_unitario' => 0,
            'subtotal' => 0
        ];
    }

    public function eliminarCargo($index)
    {
        if ($index > 0) { // Protegemos el cargo inicial de la habitación
            unset($this->detalles[$index]);
            $this->detalles = array_values($this->detalles); // Reindexamos el array
            $this->calcularTotal();
        }
    }

    public function actualizarSubtotal($index)
    {
        $this->detalles[$index]['subtotal'] = 
            $this->detalles[$index]['cantidad'] * $this->detalles[$index]['precio_unitario'];
        $this->calcularTotal();
    }

    public function cargarItems()
    {
        if ($this->tipoSeleccionado === 'productos') {
            $this->items = Productos::where('nombre', 'like', '%' . $this->search . '%')
                ->orWhere('descripcion', 'like', '%' . $this->search . '%')
                ->get();
        } else {
            $this->items = Servicios::where('nombre', 'like', '%' . $this->search . '%')
                ->orWhere('descripcion', 'like', '%' . $this->search . '%')
                ->get();
        }
    }

    public function updatedTipoSeleccionado()
    {
        $this->cargarItems();
    }

    public function agregarItem($id)
    {
        $item = $this->tipoSeleccionado === 'productos' 
            ? Productos::find($id) 
            : Servicios::find($id);
        
        $this->detalles[] = [
            'concepto' => $item->nombre,
            'cantidad' => 1,
            'precio_unitario' => $item->precio,
            'subtotal' => $item->precio,
            'tipo' => $this->tipoSeleccionado // para referencia
        ];
        
        $this->showProductModal = false;
        $this->calcularTotal();
    }

    public function abrirModalProductos()
    {
        $this->showProductModal = true;
        $this->search = '';
        $this->tipoSeleccionado = 'productos'; // Por defecto muestra productos
        $this->cargarItems();
    }

    public function generarFactura()
    {
        $this->validate([
            'metodo_pago' => 'required',
            'detalles' => 'required|array|min:1',
            'total' => 'required|numeric|min:0'
        ], [
            'metodo_pago.required' => 'Debe seleccionar un método de pago',
            'detalles.min' => 'Debe haber al menos un cargo en la factura',
            'total.min' => 'El total debe ser mayor a 0'
        ]);

        try {
            DB::beginTransaction();

            // 1. Crear la factura
            $factura = Factura::create([
                'reserva_id' => $this->reserva->id,
                'usuario_id' => auth()->id(),
                'fecha_emision' => now(),
                'metodo_pago' => $this->metodo_pago,
                'total' => $this->total
            ]);

            // 2. Guardar los detalles
            foreach ($this->detalles as $detalle) {
                $factura->detalles()->create([
                    'concepto' => $detalle['concepto'],
                    'cantidad' => $detalle['cantidad'],
                    'precio_unitario' => $detalle['precio_unitario'],
                    'subtotal' => $detalle['subtotal']
                ]);
            }

            // 3. Crear un mantenimiento
            $personal = User::role('mantenimiento')->inRandomOrder()->first(); // Selecciona un usuario al azar con rol de mantenimiento
            $mantenimiento = Mantenimiento::create([
                'habitacion_id' => $this->reserva->habitacion_id,
                'descripcion' => 'Limpieza después de la facturación', // Descripción por defecto
                'personal_id' => $personal ? $personal->id : null, // Asigna el ID del usuario o null si no hay
                'prioridad' => 'media',
                'estado' => 'pendiente', // Estado inicial del mantenimiento
            ]);

            // 4. Actualizar el estado de la reserva
            $this->reserva->update(['estado' => 'check_out']);

            // 5. Actualizar el estado de la habitación a "En Mantenimiento"
            $habitacion = Habitacion::find($this->reserva->habitacion_id);
            $habitacion->update(['disponibilidad' => 'mantenimiento']);

            DB::commit();
            session()->flash('message', 'Factura generada correctamente y mantenimiento creado');
            return redirect()->route('check-out');

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Error al generar la factura: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.facturacion-component')->layout('layouts.app');
    }
}
