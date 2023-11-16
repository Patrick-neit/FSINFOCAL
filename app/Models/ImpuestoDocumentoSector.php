<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImpuestoDocumentoSector extends Model
{
    use HasFactory;

    protected $table = 'impuestos_documentos_sectores';

    protected $fillable =
    [
        'codigo_clasificador',
        'descripcion',
    ];
}
