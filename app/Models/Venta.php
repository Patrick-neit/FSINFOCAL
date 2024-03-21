<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $table = 'ventas';

    protected $fillable = [
        'nit_emisor',
        'razon_social_emisor',
        'municipio',
        'hora_venta',
        'numero_factura',
        'cuf_emision',
        'cufd',
        'direccion',
        'fecha_venta',
        'codigo_metodo_pago',
        'total_venta',
        'monto_total_sujeto_iva',
        'descuento',
        'total',
        'monto_gifcard',
        'tipo_cambio',
        'debito_fiscal',
        'estado_emision',
        'estado_documento',
        'codigo_estado',
        'codigo_descripcion',
        'codigo_control',
        'estado_anulacion',
        'codigo_doc_sector',
        'codigo_qr',
        'estado_reversion',
        'numero_tarjeta',
        'codigo_moneda',
        'user_id',
        'cliente_id',
        'codigo_punto_venta',
        'sucursal_id',
        'cantidad_habitaciones',
        'cantidad_huespedes',
        'cantidad_mayores',
        'cantidad_menores',
        'anulacion_user',
        'reversion_user',
        'fecha_anulacion',
        'fecha_reversion',
        'periodo_facturado',
        'nombre_estudiante',
        'leyenda',
        'codigo_exepcion',
        'codigo_evento',
        'cafc',
    ];

    public function metodo_pago()
    {
        return $this->belongsTo(ImpuestoMetodoPago::class, 'codigo_clasificador', 'tipo_pago_id');
    }

    public function tipo_moneda()
    {
        return $this->belongsTo(ImpuestoTipoMoneda::class, 'codigo_clasificador', 'moneda_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }

    public function detalles_ventas()
    {
        return $this->hasMany(DetalleVenta::class, 'venta_id');
    }
}
