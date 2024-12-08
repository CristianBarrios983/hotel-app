<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    use HasFactory;

    protected $table = 'configuracion';

    protected $fillable = [
        'nombre_hotel',
        'razon_social',
        'cuit',
        'correo',
        'telefono',
        'direccion',
        'sitio_web',
        'otros_detalles',
    ];
}
