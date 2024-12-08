<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Productos;
use App\Models\Categorias;

class ProductosComponent extends Component
{

    public $productos, $productoId, $nombreProducto, $descripcion, $precio, $stock, $stockMinimo, $categoria_id;

    public $categorias = [];

    public $isCreateModalOpen = 0;
    public $isEditModalOpen = 0;

    public function mount()
    {
        $this->categorias = Categorias::all();
    }

    public function render()
    {
        // $this->productos = Productos::all();
        // $this->productos = Productos::join('categorias', 'categorias.id', '=', 'productos.categoria_id')
        // ->select(
        //     'productos.id', 
        //     'productos.nombre as producto_nombre', 
        //     'productos.descripcion', 
        //     'productos.precio', 
        //     'productos.stock', 
        //     'productos.stock_minimo', 
        //     'productos.created_at', 
        //     'categorias.nombre_categoria as categoria'
        // )
        // ->get();


        // Cargar los productos con sus categorías
        $this->productos = Productos::with('categoria')->get();
        return view('livewire.productos-component')->layout('layouts.app');
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
        $this->productoId = null;
        $this->nombreProducto = '';
        $this->descripcion = '';
        $this->precio = '';
        $this->stock = '';
        $this->stockMinimo = '';
        $this->categoria_id = null;
    }

    public function almacenar()
    {
        $this->validate([
            'nombreProducto' => 'required|string',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
            'stockMinimo' => 'required|numeric|min:0',
            'categoria_id' => 'required|exists:categorias,id',
        ], [
            'nombreProducto.required' => 'El nombre del producto es obligatorio.',
            'nombreProducto.string' => 'El nombre debe ser texto.',
            'descripcion.string' => 'La descripción debe ser texto.',
            'precio.required' => 'El precio es obligatorio.',
            'precio.numeric' => 'El precio debe ser un número.',
            'precio.min' => 'El precio debe ser mayor o igual a 0.',
            'stock.required' => 'El stock es obligatorio.',
            'stock.numeric' => 'El stock debe ser un número.',
            'stock.min' => 'El stock debe ser mayor o igual a 0.',
            'stockMinimo.required' => 'El stock mínimo es obligatorio.',
            'stockMinimo.numeric' => 'El stock mínimo debe ser un número.',
            'stockMinimo.min' => 'El stock mínimo debe ser mayor o igual a 0.',
            'categoria_id.required' => 'La categoría es obligatoria.',
            'categoria_id.exists' => 'La categoría seleccionada no es válida.'
        ]);
        
        Productos::create([
            'nombre' => $this->nombreProducto,
            'descripcion' => $this->descripcion,
            'precio' => $this->precio,
            'stock' => $this->stock,
            'stock_minimo' => $this->stockMinimo,
            'categoria_id' => $this->categoria_id,
        ]);

        session()->flash('message', 'Producto creado con éxito.');
        $this->cerrarModalCrear();
    }

    
    // Abrir y cerrar modales de edición
    public function abrirModalEditar($id)
    {
        $this->resetearCampos();
        $this->productoId = $id;
        $this->cargarDatosProducto($id);
        $this->isEditModalOpen = true;
    }

    public function cerrarModalEditar()
    {
        $this->resetearCampos();
        $this->isEditModalOpen = false;
    }

    private function cargarDatosProducto($id)
    {
        $producto = Productos::findOrFail($id);
        $this->nombreProducto = $producto->nombre;
        $this->descripcion = $producto->descripcion;
        $this->precio = $producto->precio;
        $this->stock = $producto->stock;
        $this->stockMinimo = $producto->stock_minimo;
        $this->categoria_id = $producto->categoria_id;
    }

    // Actualizar categoria existente
    public function actualizar()
    {
        $this->validate([
            'nombreProducto' => 'required|string',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
            'stockMinimo' => 'required|numeric|min:0',
            'categoria_id' => 'required|exists:categorias,id',
        ], [
            'nombreProducto.required' => 'El nombre del producto es obligatorio.',
            'nombreProducto.string' => 'El nombre debe ser texto.',
            'descripcion.string' => 'La descripción debe ser texto.',
            'precio.required' => 'El precio es obligatorio.',
            'precio.numeric' => 'El precio debe ser un número.',
            'precio.min' => 'El precio debe ser mayor o igual a 0.',
            'stock.required' => 'El stock es obligatorio.',
            'stock.numeric' => 'El stock debe ser un número.',
            'stock.min' => 'El stock debe ser mayor o igual a 0.',
            'stockMinimo.required' => 'El stock mínimo es obligatorio.',
            'stockMinimo.numeric' => 'El stock mínimo debe ser un número.',
            'stockMinimo.min' => 'El stock mínimo debe ser mayor o igual a 0.',
            'categoria_id.required' => 'La categoría es obligatoria.',
            'categoria_id.exists' => 'La categoría seleccionada no es válida.'
        ]);

        Productos::find($this->productoId)->update([
            'nombre' => $this->nombreProducto,
            'descripcion' => $this->descripcion,
            'precio' => $this->precio,
            'stock' => $this->stock,
            'stock_minimo' => $this->stockMinimo,
            'categoria_id' => $this->categoria_id,
        ]);

        session()->flash('message', 'Producto actualizado con éxito.');
        $this->cerrarModalEditar();
    }

    // Eliminar categoria
    public function eliminar($id)
    {
        Productos::find($id)->delete();
        session()->flash('message', 'Producto eliminado con éxito.');
    }
}
