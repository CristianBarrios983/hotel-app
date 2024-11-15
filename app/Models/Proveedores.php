<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedores extends Model
{
    use HasFactory;

    protected $table = 'proveedores';

    protected $fillable = [
        'nombre_proveedor',
        'telefono',
        'email',
        'direccion',
        'descripcion',
        'categoria_id'
    ];


    // Relación con la tabla categorías
    public function categoria()
    {
        return $this->belongsTo(Categorias::class, 'categoria_id');
    }
}
