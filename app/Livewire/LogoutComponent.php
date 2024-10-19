<?php

namespace App\Livewire;

use App\Livewire\Actions\Logout;
use Livewire\Component;

class LogoutComponent extends Component
{

    public function logout(Logout $logout): void
    {
        $logout(); // Cierra la sesión

        // Redirige a la página de inicio utilizando el método de Livewire
        $this->redirect('/'); 
    }

    public function render()
    {
        return view('livewire.logout-component');
    }
}
