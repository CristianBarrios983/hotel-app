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

    // Relación con la tabla proveedores
    public function proveedores()
    {
        return $this->belongsTo(Proveedores::class, 'proveedor_id');
    }

}
