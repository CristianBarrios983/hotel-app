<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $fillable = ['nombre_producto', 'descripcion', 'precio', 'stock', 'stock_minimo', 'categoria_id'];
}
