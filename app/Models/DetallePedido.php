<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetallePedido extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'detalle_pedidos';

    public $fillable = [
        'pedido_id',
        'producto_id',
        'cantidad',
        'precio_unitario',
        'sub_total'
    ];
}
