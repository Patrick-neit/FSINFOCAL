<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImpuestoProductoServicio extends Model
{
    use HasFactory;

    protected $table = 'impuestos_productos_servicios';

    protected $fillable =
    [
        'codigo_actividad',
        'codigo_producto',
        'descripcion_producto',
    ];
}
