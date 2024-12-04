<?php

namespace App\Livewire;

use Livewire\Component;

class LogoutComponent extends Component
{
    public function logout(): void
    {
        auth()->logout();
        $this->redirect('/');
    }

    public function render()
    {
        return view('livewire.logout-component');
    }
}
