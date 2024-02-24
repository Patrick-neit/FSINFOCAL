<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedido extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'pedidos';

    public $fillable = [
        'fecha',
        'hora',
        'proveedor_id',
        'aprobado',
        'usuario_id',
        'total',
        'nota',
    ];

    protected function aprobado(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value == 1 ? 'Aprobado' : 'Pendiente',
        );
    }

    public function detalle_pedido()
    {
        return $this->hasMany(DetallePedido::class, 'pedido_id');
    }
}
