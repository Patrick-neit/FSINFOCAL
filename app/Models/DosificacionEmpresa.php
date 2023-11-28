<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DosificacionEmpresa extends Model
{
    use HasFactory;
    protected $table = 'dosificaciones_empresas';
    protected $fillable = [
        'fecha_asignacion',
        'empresa_id',
        'estado'
    ];

    public function empresa(){
        return $this->belongsTo(Empresa::class);
    }

    public function detalles_dosificaciones_empresas(){
        return $this->hasMany(DetalleDosificacionEmpresa::class);
    }
}
