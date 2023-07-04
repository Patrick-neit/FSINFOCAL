<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumnoCurso extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'alumnos_cursos';
    protected $fillable = [
        'alumno_id',
        'docente_id',
        'curso_id'
    ];
}
