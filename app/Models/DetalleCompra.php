<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetalleCompra extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'detalle_compras';

    public $fillable = [
        'compra_id',
        'producto_id',
        'cantidad',
        'precio_unitario',
        'sub_total',
        'fecha_vencimiento'
    ];

    public function cabecera_compra()
    {
        return $this->belongsTo(CabeceraCompra::class);
    }
}
