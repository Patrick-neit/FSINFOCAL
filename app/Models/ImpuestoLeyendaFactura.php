<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ImpuestoLeyendaFactura extends Model
{
    use HasFactory;

    protected $table = 'impuestos_leyendas_facturas';

    public $timestamps = false;

    protected $fillable =
    [
        'codigo_actividad',
        'descripcion_leyenda',
        'transaccion',
    ];

    protected function transaccion(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value == 1 ? 'Sincronizado' : 'No sincronizado',
        );
    }
}
