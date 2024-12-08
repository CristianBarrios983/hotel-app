<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habitacion extends Model
{
    use HasFactory;

    protected $table = 'habitaciones';

    protected $fillable = [
        'numero_habitacion',
        'capacidad',
        'tamano',
        'vistas',
        'tipo_cama',
        'precio_por_noche',
        'disponibilidad',
        'tipo_habitacion_id',
        'piso_id',
    ];

    public function tipoHabitacion()
    {
        return $this->belongsTo(TipoHabitacion::class);
    }

    // Relación con la tabla pisos
    public function pisos()
    {
        return $this->belongsTo(Piso::class, 'piso_id');
    }

    // Relación con la tabla tipo_habitaciones
    public function tipos_habitaciones()
    {
        return $this->belongsTo(TipoHabitacion::class, 'tipo_habitacion_id');
    }
}
