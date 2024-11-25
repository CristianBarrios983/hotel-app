<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservas extends Model
{
    use HasFactory;

    protected $table = 'reservas';

    protected $fillable = [
        'habitacion_id',
        'check_in',
        'check_out',
        'huesped_id',
        'estado',
        'observaciones',
        'usuario_id'
    ];

    // Relaciones
    public function habitacion()
    {
        return $this->belongsTo(Habitacion::class);
    }

    public function huesped()
    {
        return $this->belongsTo(Huesped::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
