<?php

namespace App\Http\Controllers;

use App\Models\CabeceraCompra;
use App\Models\DetalleCompra;
use App\Models\DetallePedido;
use App\Models\ImpuestoMetodoPago;
use App\Models\KardexProducto;
use App\Models\Pedido;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ComprasController extends Controller
{
    public function compras_index(Pedido $pedido)
    {
        //dd(DetallePedido::with('producto', 'pedido')->where('pedido_id', $pedido->id)->get());
        return view('compras.aprobado_index', [
            'pedido' => $pedido,
            'metodos_pagos' => ImpuestoMetodoPago::all(),
            'proveedores' => Proveedor::all(),
            'detalle_pedido' => DetallePedido::with('producto', 'pedido')->where('pedido_id', $pedido->id)->get(),
        ]);
    }
    public function aprobar_pedido(Request $request)
    {
        $pedido = Pedido::find($request->pedido_id);
        $cabecera_compra = CabeceraCompra::create([
            'tipo_documento_id' => $request->tipo_documento,
            'numero_documento' => $request->numero_documento,
            'proveedor_id' => $pedido->proveedor_id,
            'fecha' => Carbon::now()->format('Y-m-d'),
            'hora' => Carbon::now()->format('H:m:s'),
            'total' => $pedido->total,
            'user_id' => auth()->user()->id,
            'metodo_pago_id' => $request->metodo_pago,
            'nota' => $pedido->nota,
            'lote' => $request->lote
        ]);
        $detalle_pedido = DetallePedido::where('pedido_id', $pedido->id)->get();
        $i = 0;
        foreach ($detalle_pedido as $detalle) {
            $cabecera_compra->compra_detalles()->create([
                'compra_id' => $cabecera_compra->id,
                'producto_id' => $detalle->producto_id,
                'cantidad' => $detalle->cantidad,
                'precio_unitario' => $detalle->precio_unitario,
                'sub_total' => $detalle->sub_total,
                'fecha_vencimiento' => Carbon::createFromDate($request->productos[$i]["fecha_vencimiento"])->format('Y-m-d'),
            ]);
            $kardex_nuevo = new KardexProducto();
            $kardex_producto = KardexProducto::where('producto_id', $detalle->producto_id)->latest()->first();

            $kardex_nuevo->producto_id = $detalle->producto_id;
            $kardex_nuevo->fecha = Carbon::now()->format('Y-m-d');
            $kardex_nuevo->hora = Carbon::now()->format('H:m:s');
            $kardex_nuevo->doc_soporte = '123';
            $kardex_nuevo->tipo_movimiento = 'Ingreso';
            $kardex_nuevo->cantidad_ingresos = $detalle->cantidad;
            $kardex_nuevo->precio_unitario_ingresos = $detalle->precio_unitario;
            $kardex_nuevo->total_ingresos = $detalle->cantidad * $detalle->precio_unitario;
            $kardex_nuevo->cantidad_egresos = 0;
            $kardex_nuevo->precio_unitario_egresos = 0;
            $kardex_nuevo->total_egresos = 0;
            $kardex_nuevo->cantidad_saldo_actual = $kardex_producto->cantidad_saldo_actual + $detalle->cantidad;
            $kardex_nuevo->promedio = ($kardex_producto->costo_total_saldo + ($detalle->cantidad * $detalle->precio_unitario)) / $kardex_nuevo->cantidad_saldo_actual; // ?????
            $kardex_nuevo->costo_total_saldo = $kardex_nuevo->cantidad_saldo_actual * $kardex_nuevo->promedio;
            $kardex_nuevo->utilidad = 0;
            $kardex_nuevo->usuario_id = auth()->user()->id;
            $kardex_nuevo->save();
            $i++;
        }
        $pedido->update([
            'aprobado' => 1
        ]);

        return responseJson('Aprobado', $cabecera_compra, 200);
    }
}
