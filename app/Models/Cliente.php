<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use HasFactory, SoftDeletes;

    public $fillable = [
        'nombre_cliente',
        'tipo_documento_id',
        'numero_nit',
        'complemento',
        'direccion',
        'telefono',
        'correo',
        'departamento_id',
        'fecha_cumpleanos',
        'contacto',
        'estado',
    ];

    protected function estado(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value == 1 ? 'Activo' : 'Inactivo',
        );
    }

    public function impuestos_documentos_identidad()
    {
        return $this->belongsTo(ImpuestoDocumentoIdentidad::class, 'tipo_documento_id', 'id');
    }

    public function clientes_tipos_precios()
    {
        return $this->hasMany(ClienteTipoPrecio::class);
    }

    public function catalogos_precios_productos()
    {
        return $this->hasOne(CatalogoPrecioProducto::class);
    }
}
