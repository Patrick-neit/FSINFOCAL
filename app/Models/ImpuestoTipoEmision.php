<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImpuestoTipoEmision extends Model
{
    use HasFactory;

    protected $table = 'impuestos_tipos_emisiones';

    protected $fillable =
    [
        'codigo_clasificador',
        'descripcion',
    ];
}
