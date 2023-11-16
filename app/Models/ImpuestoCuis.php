<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImpuestoCuis extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'impuestos_cuis';

    protected $fillable =
    [
        'fecha_generado',
        'fecha_vencimiento',
        'codigo_cuis',
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
