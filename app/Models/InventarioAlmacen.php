<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventarioAlmacen extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'inventario_almacenes';

    public $fillable = [
        'almacen_id',
        'producto_id'
    ];
}
