<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserComponent extends Component
{
    public $users; 
    public $usuarioId, $nombre, $correo, $telefono, $direccion, $rol, $contrasena, $contrasena_confirmation;

    public $isCreateModalOpen = 0;
    public $isEditModalOpen = 0;

    public function render()
    {
        $this->users = User::all(); // Carga todos los usuarios
        return view('livewire.user-component')->layout('layouts.app');
    }

    // Abrir y cerrar modales de creación
    public function abrirModalCrear()
    {
        $this->resetearCampos();
        $this->isCreateModalOpen = true;
    }

    public function cerrarModalCrear()
    {
        $this->resetearCampos();
        $this->isCreateModalOpen = false;
    }

    // Abrir y cerrar modales de edición
    public function abrirModalEditar($id)
    {
        $this->resetearCampos();
        $this->usuarioId = $id;
        $this->cargarDatosUsuario($id);
        $this->isEditModalOpen = true;
    }

    public function cerrarModalEditar()
    {
        $this->resetearCampos();
        $this->isEditModalOpen = false;
    }

    private function resetearCampos()
    {
        $this->usuarioId = null;
        $this->nombre = '';
        $this->correo = '';
        $this->telefono = '';
        $this->direccion = '';
        $this->rol = null; // O puedes usar un valor por defecto si es necesario
        $this->contrasena = '';
        $this->contrasena_confirmation = '';
    }

    private function cargarDatosUsuario($id)
    {
        $usuario = User::findOrFail($id);
        $this->nombre = $usuario->name;
        $this->correo = $usuario->email;
        $this->telefono = $usuario->phone;
        $this->direccion = $usuario->address;
    }

    public function almacenar()
    {
        $this->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|unique:users,email',
            'telefono' => 'nullable|string|max:15',
            'direccion' => 'nullable|string|max:255',
            'contrasena' => 'required|string|min:8|confirmed',
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser texto.',
            'nombre.max' => 'El nombre no puede tener más de 255 caracteres.',
            'correo.required' => 'El correo electrónico es obligatorio.',
            'correo.email' => 'El correo electrónico debe ser una dirección válida.',
            'correo.unique' => 'El correo electrónico ya está en uso.',
            'telefono.string' => 'El teléfono debe ser texto.',
            'telefono.max' => 'El teléfono no puede tener más de 15 caracteres.',
            'direccion.string' => 'La dirección debe ser texto.',
            'direccion.max' => 'La dirección no puede tener más de 255 caracteres.',
            'contrasena.required' => 'La contraseña es obligatoria.',
            'contrasena.string' => 'La contraseña debe ser texto.',
            'contrasena.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'contrasena.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        User::create([
            'name' => $this->nombre,
            'email' => $this->correo,
            'phone' => $this->telefono,
            'address' => $this->direccion,
            'password' => Hash::make($this->contrasena), // Asegúrate de hashear la contraseña
        ]);

        session()->flash('message', 'Usuario creado con éxito.');
        $this->cerrarModalCrear();
    }

    public function eliminar($id)
    {
        User::find($id)->delete();
        session()->flash('message', 'Usuario eliminado con éxito.');
    }

    public function actualizar()
    {
        $this->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email',
            'telefono' => 'nullable|string|max:15',
            'direccion' => 'nullable|string|max:255',
            'contrasena' => 'nullable|string|min:8|confirmed', // La contraseña es opcional
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser texto.',
            'nombre.max' => 'El nombre no puede tener más de 255 caracteres.',
            'correo.required' => 'El correo electrónico es obligatorio.',
            'correo.email' => 'El correo electrónico debe ser una dirección válida.',
            'telefono.string' => 'El teléfono debe ser texto.',
            'telefono.max' => 'El teléfono no puede tener más de 15 caracteres.',
            'direccion.string' => 'La dirección debe ser texto.',
            'direccion.max' => 'La dirección no puede tener más de 255 caracteres.',
            'contrasena.string' => 'La contraseña debe ser texto.',
            'contrasena.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'contrasena.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        $usuario = User::find($this->usuarioId);

        $usuario->name = $this->nombre;
        $usuario->email = $this->correo;
        $usuario->phone = $this->telefono;
        $usuario->address = $this->direccion;

        // Solo actualizar la contraseña si se proporciona una nueva
        if ($this->contrasena) {
            $usuario->password = Hash::make($this->contrasena);
        }

        $usuario->save();

        session()->flash('message', 'Usuario actualizado con éxito.');
        $this->cerrarModalEditar();
    }
}
