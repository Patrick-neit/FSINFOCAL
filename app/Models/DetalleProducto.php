<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetalleProducto extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'detalle_productos';

    public $fillable = [
        'producto_id',
        'precio_compra',
        'precio_unitario',
        'precio_unitario2',
        'precio_unitario3',
        'precio_unitario4',
        'precio_paquete',
        'precio_venta_dolar',
    ];

    public function cabecera_producto()
    {
        return $this->belongsTo(CabeceraProducto::class);
    }
}
