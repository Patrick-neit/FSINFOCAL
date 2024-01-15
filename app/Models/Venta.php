<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    protected $table = 'ventas';
    protected $fillable = [
        'fecha_venta',
        'hora_venta',
        'numero_factura',
        'total',
        'descuento',
        'monto_giftcard',
        'total_venta',
        'cuf_emision',
        'estado_emision',
        'estado_anulacion',
        'estado_reversion',
        'cufd_id',
        'numero_tarjeta',
        'tipo_pago_id',
        'moneda_id',
        'user_id',
        'cliente_id',
        'codigo_punto_venta',
        'sucursal_id',
        'leyenda',
        'evento_significativo_id'
    ];

    public function metodo_pago(){
        return $this->belongsTo(ImpuestoMetodoPago::class,'codigo_clasificador','tipo_pago_id');
    }
    public function tipo_moneda(){
        return $this->belongsTo(ImpuestoTipoMoneda::class,'codigo_clasificador','moneda_id');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }
    public function sucursal(){
        return $this->belongsTo(Sucursal::class);
    }

    public function detalles_ventas()
    {
        return $this->hasMany(DetalleVenta::class, 'venta_id');
    }

}
