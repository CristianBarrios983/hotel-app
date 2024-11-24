<?php

namespace App\Livewire;

use Livewire\Component;

class ReservasComponent extends Component
{

    public $isCreateModalOpen = 0;
    public $isEditModalOpen = 0;

    public function render()
    {
        return view('livewire.reservas-component');
    }
}
