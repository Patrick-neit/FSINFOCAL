<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImpuestoDocumentoIdentidad extends Model
{
    use HasFactory;
    protected $table = 'impuestos_documentos_identidades';
    protected $fillable =
    [
        'codigo_clasificador',
        'descripcion'
    ];
}
