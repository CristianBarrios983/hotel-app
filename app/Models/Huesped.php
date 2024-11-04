<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Huesped extends Model
{
    use HasFactory;

    protected $table = 'huespedes';

    protected $fillable = [
        'nombre',
        'apellido',
        'fecha_nacimiento',
        'nacionalidad',
        'tipo_documento',
        'numero_documento',
        'email',
        'telefono'
    ];

    protected $dates = ['fecha_nacimiento', 'created_at', 'updated_at'];

}
