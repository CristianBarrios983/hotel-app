<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    protected $table = 'facturas';

    protected $fillable = [
        'reserva_id',
        'usuario_id',
        'fecha_emision',
        'metodo_pago',
        'total'
    ];

    // Relaciones
    public function reserva()
    {
        return $this->belongsTo(Reservas::class);
    }

    public function detalles()
    {
        return $this->hasMany(DetalleFactura::class);
    }
}
