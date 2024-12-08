<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class PerfilComponent extends Component
{

    public $nombre;
    public $correo;
    public $telefono;
    public $direccion;

    public function mount()
    {
        $usuario = Auth::user();
        $this->nombre = $usuario->name;
        $this->correo = $usuario->email;
        $this->telefono = $usuario->phone;
        $this->direccion = $usuario->address;
    }

    public function actualizarPerfil()
    {
        $this->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|max:255',
            'telefono' => 'nullable|string|max:15',
            'direccion' => 'nullable|string|max:255',
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser texto.',
            'correo.required' => 'El correo electrónico es obligatorio.',
            'correo.email' => 'El correo electrónico debe ser una dirección válida.',
            'telefono.string' => 'El teléfono debe ser texto.',
            'telefono.max' => 'El teléfono no puede tener más de 15 caracteres.',
            'direccion.string' => 'La dirección debe ser texto.',
            'direccion.max' => 'La dirección no puede tener más de 255 caracteres.',
        ]);

        $usuario = Auth::user();
        $usuario->name = $this->nombre;
        $usuario->email = $this->correo;
        $usuario->phone = $this->telefono;
        $usuario->address = $this->direccion;
        $usuario->save();

        session()->flash('message', 'Perfil actualizado con éxito.');
    }

    public function render()
    {
        return view('livewire.perfil-component');
    }
}
