<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImpuestoLeyendaFactura extends Model
{
    use HasFactory;
    protected $table = 'impuestos_leyendas_facturas';
    protected $fillable =
    [
        'codigo_actividad',
        'descripcion_leyenda'
    ];
}
