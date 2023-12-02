<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImpuestoProductoServicio extends Model
{
    use HasFactory;

    protected $table = 'impuestos_productos_servicios';

    public $timestamps = false;

    protected $fillable =
    [
        'codigo_actividad',
        'codigo_producto',
        'descripcion_producto',
        'nandina',
        'transaccion',
    ];

    protected function transaccion(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value == 1 ? 'Sincronizado' : 'No sincronizado',
        );
    }
}
