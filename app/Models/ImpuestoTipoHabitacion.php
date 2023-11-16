<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImpuestoTipoHabitacion extends Model
{
    use HasFactory;

    protected $table = 'impuestos_tipos_habitaciones';

    protected $fillable =
    [
        'codigo_clasificador',
        'descripcion',
    ];
}
