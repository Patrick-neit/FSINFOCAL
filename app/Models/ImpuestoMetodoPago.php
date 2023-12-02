<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImpuestoMetodoPago extends Model
{
    use HasFactory;

    protected $table = 'impuestos_metodos_pagos';

    public $timestamps = false;

    protected $fillable =
    [
        'codigo_clasificador',
        'descripcion',
        'transaccion',
    ];

    protected function transaccion(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value == 1 ? 'Sincronizado' : 'No sincronizado',
        );
    }
}
