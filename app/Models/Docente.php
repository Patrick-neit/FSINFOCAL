<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Docente extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'docentes';
    protected $fillable = [
        'nombre_completo',
        'matricula',
        'fecha_incorporacion',
        'telefono',
        'direccion',
        'estado'
    ];
}
