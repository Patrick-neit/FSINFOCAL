<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImpuestoListadoPais extends Model
{
    use HasFactory;

    protected $table = 'impuestos_listados_paises';

    protected $fillable =
    [
        'codigo_clasificador',
        'descripcion',
    ];
}
