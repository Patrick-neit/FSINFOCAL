<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImpuestoMetodoPago extends Model
{
    use HasFactory;

    protected $table = 'impuestos_metodos_pagos';

    protected $fillable =
    [
        'codigo_clasificador',
        'descripcion',
    ];
}
