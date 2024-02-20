<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Almacen extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'almacenes';
    protected $fillable =
    [
        'nombre',
        'capacidad_almacen',
        'encargado_id',
        'sucursal_id'
    ];

    public function encargado()
    { //TODO verify if this relation works
        return $this->belongsTo(User::class);
    }

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }

    public function cabeceraProductos()
    {
        return $this->belongsToMany(CabeceraProducto::class, 'inventario_almacenes', 'almacen_id', 'producto_id');
    }
}
