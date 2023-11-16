<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PuntoVentaCufd extends Model
{
    use HasFactory;

    protected $table = 'puntos_ventas_cufds';

    protected $fillable =
    [
        'cuis_id',
        'cufd_id',
        'punto_venta_id',
    ];
}
