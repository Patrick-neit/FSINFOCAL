<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alumno extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'alumnos';

    protected $fillable =
    [
        'nombre',
        'apellido',
        'ci',
        'lugar_nacimiento',
        'fecha_nacimiento',
        'domicilio',
        'celular',
        'sexo',
        'email',
        'beca'
    ];

}
