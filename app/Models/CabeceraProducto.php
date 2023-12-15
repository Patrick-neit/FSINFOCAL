<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class CabeceraProducto extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'cabecera_productos';

    public $fillable = [
        'dosificacion_id',
        'unidad_medida_id',
        'marca_id',
        'categoria_id',
        'tipo_id',
        'sub_familia_id',
        'codigo_producto',
        'nombre_producto',
        'codigo_producto_impuestos',
        'modelo',
        'numero_serie',
        'numero_imei',
        'peso_unitario',
        'codigo_barra',
        'caracteristicas',
        'stock_minimo',
        'stock_actual',
        'estado'
    ];

    protected function estado(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value == 1 ? 'Activo' : 'Inactivo',
        );
    }

    public function detalle_producto()
    {
        return $this->hasOne(DetalleProducto::class, 'producto_id');
    }
}
