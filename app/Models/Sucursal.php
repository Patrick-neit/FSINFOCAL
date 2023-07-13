<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sucursal extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'sucursales';

    protected $fillable =
    [
        'nombre_sucursal',
        'direccion',
        'codigo_sucursal',
        'telefono',
        'empresa_id'
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
