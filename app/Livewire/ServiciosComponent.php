<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Servicios;

class ServiciosComponent extends Component
{

    public $servicios, $servicioId, $nombre, $descripcion, $precio, $disponibilidad;
    public $isCreateModalOpen = 0;
    public $isEditModalOpen = 0;

    public function render()
    {
        $this->servicios = Servicios::all();
        return view('livewire.servicios-component')->layout('layouts.app');
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
        $this->servicioId = null;
        $this->nombre = '';
        $this->descripcion = '';
        $this->precio = '';
        $this->disponibilidad = '';
    }

    public function almacenar()
    {
        $this->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:255',
            'precio' => 'required|numeric|min:0',      
            'disponibilidad' => 'required|boolean',     
        ], [
            'nombre.required' => 'El nombre del servicio es obligatorio.',
            'nombre.string' => 'El nombre debe ser texto.',
            'nombre.max' => 'El nombre no puede tener más de 255 caracteres.',
            'descripcion.string' => 'La descripción debe ser texto.',
            'descripcion.max' => 'La descripción no puede tener más de 255 caracteres.',
            'precio.required' => 'El precio es obligatorio.',
            'precio.numeric' => 'El precio debe ser un número.',
            'precio.min' => 'El precio debe ser mayor o igual a 0.',
            'disponibilidad.required' => 'La disponibilidad es obligatoria.',
            'disponibilidad.boolean' => 'La disponibilidad debe ser verdadero o falso.'
        ]);

        Servicios::create([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'precio' => $this->precio,
            'disponibilidad' => $this->disponibilidad,
        ]);

        session()->flash('message', 'Servicio creado con éxito.');
        $this->cerrarModalCrear();
    }

    // Abrir y cerrar modales de edición
    public function abrirModalEditar($id)
    {
        $this->resetearCampos();
        $this->servicioId = $id;
        $this->cargarDatosServicio($id);
        $this->isEditModalOpen = true;
    }

    public function cerrarModalEditar()
    {
        $this->resetearCampos();
        $this->isEditModalOpen = false;
    }

    // Cargar los datos del servicio para editar
    private function cargarDatosServicio($id)
    {
        $servicio = Servicios::findOrFail($id);
        $this->nombre = $servicio->nombre;
        $this->descripcion = $servicio->descripcion;
        $this->precio = $servicio->precio;
        $this->disponibilidad = $servicio->disponibilidad;
    }

    public function actualizar()
    {
        $this->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:255',
            'precio' => 'required|numeric|min:0',      
            'disponibilidad' => 'required|boolean',     
        ], [
            'nombre.required' => 'El nombre del servicio es obligatorio.',
            'nombre.string' => 'El nombre debe ser texto.',
            'nombre.max' => 'El nombre no puede tener más de 255 caracteres.',
            'descripcion.string' => 'La descripción debe ser texto.',
            'descripcion.max' => 'La descripción no puede tener más de 255 caracteres.',
            'precio.required' => 'El precio es obligatorio.',
            'precio.numeric' => 'El precio debe ser un número.',
            'precio.min' => 'El precio debe ser mayor o igual a 0.',
            'disponibilidad.required' => 'La disponibilidad es obligatoria.',
            'disponibilidad.boolean' => 'La disponibilidad debe ser verdadero o falso.'
        ]);

        // Actualizar el registro del servicio en la base de datos
        $servicio = Servicios::find($this->servicioId);
        $servicio->update([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'precio' => $this->precio,
            'disponibilidad' => $this->disponibilidad,
        ]);

        // Mostrar mensaje de éxito
        session()->flash('message', 'Servicio actualizado con éxito.');

        // Cerrar el modal y resetear los campos
        $this->cerrarModalEditar();
    }

    // Eliminar huesped
    public function eliminar($id)
    {
        Servicios::find($id)->delete();
        session()->flash('message', 'Servicio eliminado con éxito.');
    }
}
