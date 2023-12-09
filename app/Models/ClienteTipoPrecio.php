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
        'cliente_id',
    ];
    public function clientes(){
        return $this->belongsTo(Cliente::class);
    }
}
