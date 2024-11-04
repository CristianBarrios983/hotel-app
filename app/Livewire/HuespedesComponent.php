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
        // Validación
        $this->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date|before:today',
            'nacionalidad' => 'nullable|string|max:100',
            'tipo_documento' => 'required|string|in:DNI,PASAPORTE,OTRO',
            'numero_documento' => 'required|string|unique:huespedes,numero_documento,' . $this->huespedId . ',id|max:50',
            'email' => 'required|email|unique:huespedes,email,' . $this->huespedId . ',id|max:255',
            'telefono' => 'nullable|string|max:20',
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

}
