<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Servicios;

class ServiciosComponent extends Component
{

    public $servicios, $servicioId, $nombre, $descripcion, $precio, $disponibilidad;
    public $isCreateModalOpen = 0;
    public $isEditModalOpen = 0;

    public function render()
    {
        $this->servicios = Servicios::all();
        return view('livewire.servicios-component')->layout('layouts.app');
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

    private function resetearCampos()
    {
        $this->servicioId = null;
        $this->nombre = '';
        $this->descripcion = '';
        $this->precio = '';
        $this->disponibilidad = '';
    }

    public function almacenar()
    {
        $this->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:255',
            'precio' => 'required|numeric|min:0',      
            'disponibilidad' => 'required|boolean',     
        ]);        
        
        Servicios::create([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'precio' => $this->precio,
            'disponibilidad' => $this->disponibilidad,
        ]);

        session()->flash('message', 'Servicio creado con éxito.');
        $this->cerrarModalCrear();
    }
}
