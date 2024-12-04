<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Configuracion;

class ConfiguracionComponent extends Component
{
    public $configuracionExistente = false;
    public $modoEdicion = false;
    public $nombre_hotel, $razon_social, $cuit, $correo, $telefono, $direccion, $sitio_web, $otros_detalles;

    public function mount()
    {
        $configuracion = Configuracion::first();
        if ($configuracion) {
            $this->configuracionExistente = true;
            $this->nombre_hotel = $configuracion->nombre_hotel;
            $this->razon_social = $configuracion->razon_social;
            $this->cuit = $configuracion->cuit;
            $this->correo = $configuracion->correo;
            $this->telefono = $configuracion->telefono;
            $this->direccion = $configuracion->direccion;
            $this->sitio_web = $configuracion->sitio_web;
            $this->otros_detalles = $configuracion->otros_detalles;
        } else {
            $this->modoEdicion = true; // Si no hay configuración, mostrar el formulario
        }
    }

    public function habilitarEdicion()
    {
        $this->modoEdicion = true;
    }

    public function cancelarEdicion()
    {
        $this->modoEdicion = false;
        $this->mount(); // Recargar datos originales
    }

    public function guardarConfiguracion()
    {
        // Validación...
        
        if ($this->configuracionExistente) {
            Configuracion::first()->update([
                'nombre_hotel' => $this->nombre_hotel,
                'razon_social' => $this->razon_social,
                'cuit' => $this->cuit,
                'correo' => $this->correo,
                'telefono' => $this->telefono,
                'direccion' => $this->direccion,
                'sitio_web' => $this->sitio_web,
                'otros_detalles' => $this->otros_detalles
            ]);
            session()->flash('message', 'Configuración actualizada exitosamente.');
        } else {
            Configuracion::create([
                'nombre_hotel' => $this->nombre_hotel,
                'razon_social' => $this->razon_social,
                'cuit' => $this->cuit,
                'correo' => $this->correo,
                'telefono' => $this->telefono,
                'direccion' => $this->direccion,
                'sitio_web' => $this->sitio_web,
                'otros_detalles' => $this->otros_detalles
            ]);
            session()->flash('message', 'Configuración guardada exitosamente.');
        }

        $this->configuracionExistente = true;
        $this->modoEdicion = false;
    }

    public function render()
    {
        return view('livewire.configuracion-component');
    }
}
