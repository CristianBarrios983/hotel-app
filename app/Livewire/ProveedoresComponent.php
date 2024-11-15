<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Proveedores;
use App\Models\Categorias;

class ProveedoresComponent extends Component
{

    public $proveedores, $proveedorId, $nombreProveedor, $telefono, $email, $direccion, $descripcion, $categoria_id;
    public $categorias = [];

    public $isCreateModalOpen = 0;
    public $isEditModalOpen = 0;

    public function mount()
    {
        $this->categorias = Categorias::all();
    }

    public function render()
    {
        // $this->proveedores = Proveedores::all();
        $this->proveedores = Proveedores::with('categoria')->get();
        return view('livewire.proveedores-component')->layout('layouts.app');
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

    // Reseteo de campos
    private function resetearCampos()
    {
        $this->proveedorId = null;
        $this->nombreProveedor = '';
        $this->telefono = '';
        $this->email = '';
        $this->direccion = '';
        $this->descripcion = '';
        $this->categoria_id = null;
    }

    public function almacenar()
    {
        $this->validate([
            'nombreProveedor' => 'required|string|max:255',
            'telefono' => 'required|string|max:15', 
            'email' => 'required|email|unique:proveedores,email|max:255',
            'direccion' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:255',
            'categoria_id' => 'required|exists:categorias,id',
        ]);                

        // Crear la nueva habitación en la base de datos
        Proveedores::create([
            'nombre_proveedor' => $this->nombreProveedor,
            'telefono' => $this->telefono,
            'email' => $this->email,
            'direccion' => $this->direccion,
            'descripcion' => $this->descripcion,
            'categoria_id' => $this->categoria_id,
        ]);

        // Mostrar mensaje de éxito
        session()->flash('message', 'Proveedor creado con éxito.');

        // Cerrar el modal y resetear los campos
        $this->cerrarModalCrear();
    }

    // Abrir y cerrar modales de edición
    public function abrirModalEditar($id)
    {
        $this->resetearCampos();
        $this->proveedorId = $id;
        $this->cargarDatosProveedor($id);
        $this->isEditModalOpen = true;
    }

    public function cerrarModalEditar()
    {
        $this->resetearCampos();
        $this->isEditModalOpen = false;
    }

    // Cargar los datos del proveedor para editar
    private function cargarDatosProveedor($id)
    {
        $proveedor = Proveedores::findOrFail($id);
        $this->nombreProveedor = $proveedor->nombre_proveedor;
        $this->telefono = $proveedor->telefono;
        $this->email = $proveedor->email;
        $this->direccion = $proveedor->direccion;
        $this->descripcion = $proveedor->descripcion;
        $this->categoria_id = $proveedor->categoria_id;
    }

    // Actualizar proveedor existente
    public function actualizar()
    {
        $this->validate([
            'nombreProveedor' => 'required|string|max:255',
            'telefono' => 'required|string|max:15',
            'email' => 'required|email|unique:proveedores,email,' . $this->proveedorId . '|max:255',
            'direccion' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:255',
            'categoria_id' => 'required|exists:categorias,id',
        ]);
                

        Proveedores::find($this->proveedorId)->update([
            'nombre_proveedor' => $this->nombreProveedor,
            'telefono' => $this->telefono,
            'email' => $this->email,
            'direccion' => $this->direccion,
            'descripcion' => $this->descripcion,
            'categoria_id' => $this->categoria_id,
        ]);

        session()->flash('message', 'Proveedor actualizado con éxito.');
        $this->cerrarModalEditar();
    }

    // Eliminar proveedor
    public function eliminar($id)
    {
        Proveedores::find($id)->delete();
        session()->flash('message', 'Proveedor eliminado con éxito.');
    }

}
