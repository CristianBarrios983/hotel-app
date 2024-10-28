<?php 

namespace App\Livewire;

use Livewire\Component;
use App\Models\TipoHabitacion; // Asegúrate de importar el modelo correcto

class TipoHabitacionComponent extends Component
{
    public $tipos;

    public function render()
    {
        $this->tipos = TipoHabitacion::all(); // Usa el nombre correcto del modelo
        return view('livewire.tipo-habitacion-component')->layout('layouts.app');
    }
}

