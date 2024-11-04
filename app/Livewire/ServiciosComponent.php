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
}
