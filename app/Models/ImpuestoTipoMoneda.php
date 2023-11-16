<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImpuestoTipoMoneda extends Model
{
    use HasFactory;

    protected $table = 'impuestos_tipos_monedas';

    protected $fillable =
    [
        'codigo_clasificador',
        'descripcion',
    ];
}
