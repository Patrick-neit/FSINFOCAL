<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImpuestoDocumentoSector extends Model
{
    use HasFactory;

    protected $table = 'impuestos_documentos_sectores';

    public $timestamps = false;

    protected $fillable =
    [
        'codigo_actividad',
        'codigo_documento_sector',
        'tipo_documento_sector',
        'transaccion',
    ];

    protected function transaccion(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value == 1 ? 'Sincronizado' : 'No sincronizado',
        );
    }
}
