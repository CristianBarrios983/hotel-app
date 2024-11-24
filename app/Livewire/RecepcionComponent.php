<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Habitacion;

class RecepcionComponent extends Component
{

    public $habitaciones = [];

    public function mount()
    {
        $this->habitaciones = Habitacion::all();
    }

    public function render()
    {
        return view('livewire.recepcion-component');
    }
}
