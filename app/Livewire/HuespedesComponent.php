<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Huesped;

class HuespedesComponent extends Component
{

    public $huespedes;

    public $isCreateModalOpen = 0;
    public $isEditModalOpen = 0;

    public function render()
    {
        $this->huespedes = Huesped::all();
        return view('livewire.huespedes-component')->layout('layouts.app');
    }
}
