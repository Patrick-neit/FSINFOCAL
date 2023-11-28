<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleDosificacionEmpresa extends Model
{
    use HasFactory;
    protected $table = 'detalles_dosificaciones_empresas';
    protected $fillable = [
        'descripcion_documento_sector',
        'codigo_actividad_documento_sector',
        'tipo_factura_documento_sector',
        'documento_sector_id',
        'dosificacion_empresa_id'
    ];

    public function dosificacion_empresa(){
        return $this->belongsTo(DosificacionEmpresa::class);
    }
}
