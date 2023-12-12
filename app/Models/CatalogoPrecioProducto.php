<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogoPrecioProducto extends Model
{
    use HasFactory;
    protected $table = 'catalogos_precios_productos';
    protected $fillable =
    [
        'tipo_precio_a',
        'tipo_precio_b',
        'tipo_precio_c',
        'tipo_precio_d',
        'producto_id',
        'cliente_id',
    ];

    public function producto(){
        return $this->belongsTo(CabeceraProducto::class);
    }

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }
}
