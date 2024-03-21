<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    use HasFactory;

    protected $table = 'detalles_ventas';

    protected $fillable =
    [
        'producto_id',
        'venta_id',
        'actividad_economica',
        'descripcion',
        'cantidad',
        'precio',
        'descuento_item',
        'subtotal',
        'codigo_habitacion',
        'data_json',
    ];

    public function producto()
    {
        return $this->belongsTo(CabeceraProducto::class);
    }

    public function venta()
    {
        return $this->belongsTo(Venta::class);
    }
}
