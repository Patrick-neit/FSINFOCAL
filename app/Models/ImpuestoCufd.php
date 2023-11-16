<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImpuestoCufd extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'impuestos_cufds';

    protected $fillable =
    [
        'fecha_generado',
        'fecha_vencimiento',
        'codigo_cufd',
        'codigo_control',
        'direccion',
        'estado',
        'sucursal_id',
        'empresa_id',
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
