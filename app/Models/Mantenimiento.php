<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mantenimiento extends Model
{
    use HasFactory;

    protected $table = 'mantenimientos';

    protected $fillable = [
        'habitacion_id',
        'descripcion',
        'estado',
        'prioridad',
        'personal_id'
    ];

    // Relación con Habitación
    public function habitacion()
    {
        return $this->belongsTo(Habitacion::class);
    }

    // Relación con Habitación
    public function personal()
    {
        return $this->belongsTo(User::class);
    }
}
