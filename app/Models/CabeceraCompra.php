<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CabeceraCompra extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'cabecera_compras';

    public $fillable = [
        'tipo_documento_id',
        'numero_documento',
        'proveedor_id',
        'fecha',
        'hora',
        'total',
        'user_id',
        'metodo_pago_id',
        'nota',
        'lote'
    ];

    public function compra_detalles()
    {
        return $this->hasMany(DetalleCompra::class, 'compra_id', 'id');
    }
}
