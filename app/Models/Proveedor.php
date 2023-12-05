<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proveedor extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'proveedores';

    public $fillable = [
        'nombre_proveedor',
        'direccion',
        'telefono',
        'rubro',
        'numero_nit',
        'correo',
        'contacto',
        'tipo_documento',
        'sucursal_id',
        'estado',
    ];

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }
}
