<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Proveedores;

class ProveedoresComponent extends Component
{

    public $proveedores, $proveedorId;

    public function render()
    {
        $this->proveedores = Proveedores::all();
        return view('livewire.proveedores-component')->layout('layouts.app');
    }
}
