<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePedido extends Model
{
    use HasFactory;

    protected $table = 'detalle_pedidos';

    protected $fillable = [
        'pedido_id',
        'producto_id',
        'cantidad',
        'precio_unitario',
        'subtotal',
    ];
    

    // Relación con la tabla pedidos
    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    // Relación con la tabla productos
    public function producto()
    {
        return $this->belongsTo(Productos::class, 'producto_id');
    }
}

