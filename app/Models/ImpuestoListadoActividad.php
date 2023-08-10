<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImpuestoListadoActividad extends Model
{
    use HasFactory;
    protected $table = 'impuestos_listados_actividades';
    protected $fillable =
    [
        'codigo_caeb',
        'descripcion',
        'tipo_actividad'
    ];
}
