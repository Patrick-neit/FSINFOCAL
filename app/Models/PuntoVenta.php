<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PuntoVenta extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'puntos_ventas';

    protected $fillable =
    [
        'nombre_punto_venta',
        'tipo_punto_venta',
        'codigo_punto_venta',
        'descripcion_punto_venta',
        'sucursal_id',
        'empresa_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function binacle(): MorphMany
    {
        return $this->morphMany(Binnacle::class, 'binnacleable');
    }
}
