<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class UserComponent extends Component
{
    public $users; // Define la propiedad para los usuarios

    public function render()
    {
        $this->users = User::all(); // Carga todos los usuarios
        return view('livewire.user-component')->layout('layouts.app');
    }
}
