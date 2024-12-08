<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pedidos;
use App\Models\Proveedores;
use App\Models\Productos;
use Illuminate\Support\Facades\DB;

class PedidosComponent extends Component
{
    public $proveedores, $productos, $pedidos;
    public $isDetalleModalOpen = false;
    public $pedidoSeleccionado;

    public function mount()
    {
        $this->proveedores = Proveedores::all();
        $this->productos = Productos::all();
        $this->pedidos = Pedidos::obtenerPedidosConRelaciones();
    }

    public function render()
    {
        $this->pedidos = Pedidos::all();
        return view('livewire.pedidos-component')->layout('layouts.app');
    }

    public function cancelar($pedidoId)
    {
        $pedido = Pedidos::find($pedidoId);
        if ($pedido) {
            $pedido->estado_pedido = 'Cancelado';
            $pedido->save();
            
            session()->flash('message', 'Pedido cancelado exitosamente.');
        }
    }

    public function check($pedidoId)
    {
        try {
            DB::beginTransaction(); // Inicia la transacción

            $pedido = Pedidos::find($pedidoId);
            if (!$pedido) {
                throw new \Exception('Pedido no encontrado');
            }

            // Actualiza el pedido
            $pedido->estado_pedido = 'Entregado';
            $pedido->fecha_entrega = now();
            $pedido->save();

            // Actualiza el stock de productos
            foreach($pedido->detalles as $detalle) {
                $producto = Productos::find($detalle->producto_id);
                if (!$producto) {
                    throw new \Exception('Producto no encontrado');
                }
                $producto->stock += $detalle->cantidad;
                $producto->save();
            }

            DB::commit(); // Confirma todas las operaciones
            session()->flash('message', 'Pedido marcado como entregado exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack(); // Revierte todas las operaciones si hay error
            session()->flash('error', 'Error al procesar el pedido: ' . $e->getMessage());
        }
    }

    public function verDetalles($pedidoId)
    {
        $this->pedidoSeleccionado = Pedidos::with(['proveedor', 'detalles.producto'])
            ->findOrFail($pedidoId);
        $this->isDetalleModalOpen = true;
    }

    public function cerrarModalDetalle()
    {
        $this->isDetalleModalOpen = false;
        $this->pedidoSeleccionado = null;
    }
}
