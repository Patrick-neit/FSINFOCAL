<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImpuestoMensajeServicio extends Model
{
    use HasFactory;
    protected $table = 'impuestos_mensajes_servicios';
    protected $fillable =
    [
        'codigo_clasificador',
        'descripcion'
    ];
}
