<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClienteTipoPrecio extends Model
{
    use HasFactory;

    protected $table = 'clientes_tipos_precios';

    protected $fillable =
    [
        'tipo_precio_a',
        'tipo_precio_b',
        'tipo_precio_c',
        'tipo_precio_d',
        'tipo_precio_e',
        'tipo_precio_f',
        'tipo_precio_g',
        'cliente_id',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
