<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ImpuestoDocumentoIdentidad extends Model
{
    use HasFactory;

    protected $table = 'impuestos_documentos_identidades';

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
