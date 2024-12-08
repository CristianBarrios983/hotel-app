<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Huesped;

class HuespedesComponent extends Component
{

    public $huespedes, $huespedId, $nombre, $apellido, $fecha_nacimiento, $nacionalidad, $tipo_documento, $numero_documento, $email, $telefono;

    public $isCreateModalOpen = 0;
    public $isEditModalOpen = 0;

    public function render()
    {
        $this->huespedes = Huesped::all();
        return view('livewire.huespedes-component')->layout('layouts.app');
    }

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

    private function resetearCampos()
    {
        $this->huespedId = null;
        $this->nombre = '';
        $this->apellido = '';
        $this->fecha_nacimiento = '';
        $this->nacionalidad = '';
        $this->tipo_documento = '';
        $this->numero_documento = '';
        $this->email = '';
        $this->telefono = '';
    }


    public function almacenar()
    {
        $this->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date|before:today',
            'nacionalidad' => 'nullable|string|max:100',
            'tipo_documento' => 'required|string|in:DNI,PASAPORTE,OTRO',
            'numero_documento' => 'required|string|unique:huespedes,numero_documento|max:50',
            'email' => 'required|email|unique:huespedes,email|max:255',
            'telefono' => 'nullable|string|max:20',
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser texto.',
            'nombre.max' => 'El nombre no puede tener más de 255 caracteres.',
            'apellido.required' => 'El apellido es obligatorio.',
            'apellido.string' => 'El apellido debe ser texto.',
            'apellido.max' => 'El apellido no puede tener más de 255 caracteres.',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'fecha_nacimiento.date' => 'La fecha de nacimiento no es válida.',
            'fecha_nacimiento.before' => 'La fecha de nacimiento debe ser anterior a hoy.',
            'nacionalidad.string' => 'La nacionalidad debe ser texto.',
            'nacionalidad.max' => 'La nacionalidad no puede tener más de 100 caracteres.',
            'tipo_documento.required' => 'El tipo de documento es obligatorio.',
            'tipo_documento.in' => 'El tipo de documento seleccionado no es válido.',
            'numero_documento.required' => 'El número de documento es obligatorio.',
            'numero_documento.string' => 'El número de documento debe ser texto.',
            'numero_documento.unique' => 'El número de documento ya está en uso.',
            'numero_documento.max' => 'El número de documento no puede tener más de 50 caracteres.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico no es válido.',
            'email.unique' => 'El correo electrónico ya está en uso.',
            'email.max' => 'El correo electrónico no puede tener más de 255 caracteres.',
            'telefono.string' => 'El teléfono debe ser texto.',
            'telefono.max' => 'El teléfono no puede tener más de 20 caracteres.'
        ]);
        
        Huesped::create([
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'nacionalidad' => $this->nacionalidad,
            'tipo_documento' => $this->tipo_documento,
            'numero_documento' => $this->numero_documento,
            'email' => $this->email,
            'telefono' => $this->telefono,
        ]);

        session()->flash('message', 'Huesped creado con éxito.');
        $this->cerrarModalCrear();
    }


    // Abrir y cerrar modales de edición
    public function abrirModalEditar($id)
    {
        $this->resetearCampos();
        $this->huespedId = $id;
        $this->cargarDatosHuesped($id);
        $this->isEditModalOpen = true;
    }

    public function cerrarModalEditar()
    {
        $this->resetearCampos();
        $this->isEditModalOpen = false;
    }

    // Cargar los datos del huesped para editar
    private function cargarDatosHuesped($id)
    {
        $huesped = Huesped::findOrFail($id);
        $this->nombre = $huesped->nombre;
        $this->apellido = $huesped->apellido;
        $this->fecha_nacimiento = $huesped->fecha_nacimiento;
        $this->nacionalidad = $huesped->nacionalidad;
        $this->tipo_documento = $huesped->tipo_documento;
        $this->numero_documento = $huesped->numero_documento;
        $this->email = $huesped->email;
        $this->telefono = $huesped->telefono;
    }

    public function actualizar()
    {
        $this->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date|before:today',
            'nacionalidad' => 'nullable|string|max:100',
            'tipo_documento' => 'required|string|in:DNI,PASAPORTE,OTRO',
            'numero_documento' => 'required|string|unique:huespedes,numero_documento,' . $this->huespedId . ',id|max:50',
            'email' => 'required|email|unique:huespedes,email,' . $this->huespedId . ',id|max:255',
            'telefono' => 'nullable|string|max:20',
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser texto.',
            'nombre.max' => 'El nombre no puede tener más de 255 caracteres.',
            'apellido.required' => 'El apellido es obligatorio.',
            'apellido.string' => 'El apellido debe ser texto.',
            'apellido.max' => 'El apellido no puede tener más de 255 caracteres.',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'fecha_nacimiento.date' => 'La fecha de nacimiento no es válida.',
            'fecha_nacimiento.before' => 'La fecha de nacimiento debe ser anterior a hoy.',
            'nacionalidad.string' => 'La nacionalidad debe ser texto.',
            'nacionalidad.max' => 'La nacionalidad no puede tener más de 100 caracteres.',
            'tipo_documento.required' => 'El tipo de documento es obligatorio.',
            'tipo_documento.in' => 'El tipo de documento seleccionado no es válido.',
            'numero_documento.required' => 'El número de documento es obligatorio.',
            'numero_documento.string' => 'El número de documento debe ser texto.',
            'numero_documento.unique' => 'El número de documento ya está en uso.',
            'numero_documento.max' => 'El número de documento no puede tener más de 50 caracteres.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico no es válido.',
            'email.unique' => 'El correo electrónico ya está en uso.',
            'email.max' => 'El correo electrónico no puede tener más de 255 caracteres.',
            'telefono.string' => 'El teléfono debe ser texto.',
            'telefono.max' => 'El teléfono no puede tener más de 20 caracteres.'
        ]);

        // Actualizar el registro del huesped en la base de datos
        $huesped = Huesped::find($this->huespedId);
        $huesped->update([
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'nacionalidad' => $this->nacionalidad,
            'tipo_documento' => $this->tipo_documento,
            'numero_documento' => $this->numero_documento,
            'email' => $this->email,
            'telefono' => $this->telefono,
        ]);

        // Mostrar mensaje de éxito
        session()->flash('message', 'Huesped actualizado con éxito.');

        // Cerrar el modal y resetear los campos
        $this->cerrarModalEditar();
    }

    // Eliminar huesped
    public function eliminar($id)
    {
        Huesped::find($id)->delete();
        session()->flash('message', 'Huesped eliminado con éxito.');
    }

}
