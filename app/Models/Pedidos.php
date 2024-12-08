<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    use HasFactory;

    protected $table = 'pedidos';

    protected $fillable = [
        'proveedor_id',
        'fecha_entrega',
        'estado_pedido',
        'total',
    ];

    protected $casts = [
        'fecha_entrega' => 'datetime',
    ];
    

    // Relación con la tabla detalle_pedidos
    public function detallePedidos()
    {
        return $this->hasMany(DetallePedido::class, 'pedido_id');
    }

    public function detalles()
    {
        return $this->hasMany(DetallePedido::class, 'pedido_id');
    }

    // Relación con la tabla proveedores
    public function proveedor()
    {
        return $this->belongsTo(Proveedores::class, 'proveedor_id');
    }

    // Relación con la tabla productos a través de detalle_pedidos
    public function productos()
    {
        return $this->hasManyThrough(Productos::class, DetallePedido::class, 'pedido_id', 'id', 'id', 'producto_id');
    }

    // Método para obtener pedidos con relaciones
    public static function obtenerPedidosConRelaciones()
    {
        return self::with(['proveedor', 'detallePedidos.producto'])->get();
    }

}
