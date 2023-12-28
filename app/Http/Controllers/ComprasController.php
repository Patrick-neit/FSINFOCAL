<?php

namespace App\Http\Controllers;

use App\Models\CabeceraCompra;
use App\Models\DetalleCompra;
use App\Models\DetallePedido;
use App\Models\ImpuestoMetodoPago;
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
            $i++;
        }
        $pedido->update([
            'aprobado' => 1
        ]);

        return responseJson('Aprobado', $cabecera_compra, 200);
    }
}
