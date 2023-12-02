<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImpuestoListadoActividad extends Model
{
    use HasFactory;

    protected $table = 'impuestos_listados_actividades';

    public $timestamps = false;

    protected $fillable =
    [
        'codigo_caeb',
        'descripcion',
        'tipo_actividad',
        'transaccion',
    ];

    protected function transaccion(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value == 1 ? 'Sincronizado' : 'No sincronizado',
        );
    }
}
