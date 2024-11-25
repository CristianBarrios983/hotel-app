<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    // Función para calcular noches
    public function getNochesAttribute()
    {
        if ($this->check_in && $this->check_out) {
            $checkin = Carbon::parse($this->check_in);
            $checkout = Carbon::parse($this->check_out);
            
            return floor($checkin->diffInDays($checkout));
        }
        
        return 0;
    }

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
