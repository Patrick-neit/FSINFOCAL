<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImpuestoMotivoAnulacion extends Model
{
    use HasFactory;

    protected $table = 'impuestos_motivos_anulaciones';

    protected $fillable =
    [
        'codigo_clasificador',
        'descripcion',
    ];
}
