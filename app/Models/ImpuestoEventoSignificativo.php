<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImpuestoEventoSignificativo extends Model
{
    use HasFactory;

    protected $table = 'impuestos_eventos_significativos';

    protected $fillable =
    [
        'codigo_clasificador',
        'descripcion',
    ];
}
