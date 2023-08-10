<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImpuestoFechaHora extends Model
{
    use HasFactory;
    protected $table = 'impuestos_fechas_horas';
    protected $fillable =
    [
        'fecha_hora',
    ];
}
