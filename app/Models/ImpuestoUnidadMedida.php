<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImpuestoUnidadMedida extends Model
{
    use HasFactory;

    protected $table = 'impuestos_unidades_medidas';

    protected $fillable =
    [
        'codigo_clasificador',
        'descripcion',
    ];
}
