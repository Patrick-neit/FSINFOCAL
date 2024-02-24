<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KardexProducto extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'kardex_productos';

    public $fillable = [
        'producto_id',
        'fecha',
        'hora',
        'doc_soporte',
        'tipo_movimiento',
        'cantidad_ingresos',
        'precio_unitario_ingresos',
        'total_ingresos',
        'cantidad_egresos',
        'precio_unitario_egresos',
        'total_egresos',
        'cantidad_saldo_actual',
        'promedio',
        'costo_total_saldo',
        'utilidad',
        'usuario_id',
    ];
}
