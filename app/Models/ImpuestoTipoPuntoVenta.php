<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImpuestoTipoPuntoVenta extends Model
{
    use HasFactory;
    protected $table = 'impuestos_tipos_puntos_ventas';
    protected $fillable =
    [
        'codigo_clasificador',
        'descripcion'
    ];
}
