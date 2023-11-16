<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImpuestoTipoDocumentoSector extends Model
{
    use HasFactory;

    protected $table = 'impuestos_tipos_documentos_sectores';

    protected $fillable =
    [
        'codigo_actividad',
        'codigo_documento_sector',
        'tipo_documento_sector',
    ];
}
