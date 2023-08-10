<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImpuestoTipoFactura extends Model
{
    use HasFactory;
    protected $table = 'impuestos_tipos_facturas';
    protected $fillable =
    [
        'codigo_clasificador',
        'descripcion'
    ];
}
