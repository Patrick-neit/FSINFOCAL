<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HistorialCufd extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'historial_cufd';

    protected $fillable = [
        'codigo_cufd',
        'f_inicio',
        'f_vigencia',
        'transaccion',
        'codigo_control',
        'cuis',
        'direccion',
        'sucursal_id',
        'empresa_id'
    ];

     public function sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
