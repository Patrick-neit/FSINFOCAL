<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CabeceraProducto;
use App\Models\DetallePedido;
use App\Models\ImpuestoUnidadMedida;
use App\Models\KardexProducto;
use App\Models\Pedido;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use LukePOLO\LaraCart\Facades\LaraCart;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pedidos.index', [
            'pedidos' => Pedido::with('detalle_pedido')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pedidos.create', [
            'proveedores' => Proveedor::all(),
            'cabecera_productos' => CabeceraProducto::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!empty($request->pedido_id)) {
            return $this->update($request);
        }
        $pedido = new Pedido();

        $pedido->fecha = Carbon::now()->format('Y-m-d');
        $pedido->hora = Carbon::now()->format('H:m:s');
        $pedido->proveedor_id = $request->proveedor_id;
        $pedido->aprobado = 0;
        $pedido->usuario_id = auth()->user()->id;
        $pedido->total = LaraCart::subTotal(false);
        $pedido->nota = $request->nota;
        $pedido->save();

        foreach (LaraCart::getItems() as $item) {
            $producto_id = CabeceraProducto::select('id')->where('codigo_producto', $item->id)->first()->id;
            $detalle_pedido = new DetallePedido();
            $detalle_pedido->pedido_id = $pedido->id;
            $detalle_pedido->producto_id = $producto_id;
            $detalle_pedido->cantidad = $item->qty;
            $detalle_pedido->precio_unitario = $item->price;
            $detalle_pedido->sub_total = $item->subtotal;
            $detalle_pedido->save();
            $kardex_producto = KardexProducto::where('producto_id', $producto_id)->get();
            $kardex_producto->fecha = Carbon::now()->format('Y-m-d');
            $kardex_producto->hora = Carbon::now()->format('H:m:s');
            $kardex_producto->cantidad_ingresos = $item->qty;
            $kardex_producto->save();
        }
        LaraCart::destroyCart();
        return responseJson('Guardado', $pedido, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pedido = Pedido::find($id)->load('detalle_pedido', 'detalle_pedido.producto', 'detalle_pedido.producto.detalle_producto');

        LaraCart::emptyCart();
        foreach ($pedido->detalle_pedido as $detalle) {
            LaraCart::add(
                $detalle->producto->codigo_producto,
                $detalle->producto->nombre_producto,
                $detalle->cantidad,
                $detalle->producto->detalle_producto->precio_compra,
                [
                    'subtotal' => $detalle->producto->detalle_producto->precio_compra * $detalle->cantidad,
                    'unidad_medida_literal' => ImpuestoUnidadMedida::where('codigo_clasificador', $detalle->producto->unidad_medida_id)->first()->descripcion,
                ],
                false,
                false
            );
        }

        return view('pedidos.create', [
            'pedido' => $pedido,
            'proveedores' => Proveedor::all(),
            'cabecera_productos' => CabeceraProducto::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($request)
    {
        $pedido = Pedido::find($request->pedido_id)->load('detalle_pedido');

        $pedido->update([
            'fecha' => Carbon::createFromDate($request->fecha)->format('Y-m-d'),
            'hora' => Carbon::createFromDate($request->hora)->format('H:m:s'),
            'proveedor_id' => $request->proveedor_id,
            'usuario_id' => auth()->user()->id,
            'total' => number_format((float)\LukePOLO\LaraCart\Facades\LaraCart::subTotal(false), 5, '.', '')
        ]);

        $copia_detalle = $pedido->detalle_pedido;

        if (count($copia_detalle) > count(LaraCart::getItems())) {
            foreach ($copia_detalle as $detalle) {

                $producto = CabeceraProducto::find($detalle->producto_id);

                $carrito_encontrado = LaraCart::find(['id' => $producto->codigo_producto]);

                if ($carrito_encontrado == null) {
                    $detalle->delete();
                } else {

                    $detalle_pedido = DetallePedido::where('producto_id', $producto->id)->first();

                    if (empty($detalle_pedido)) {
                        $detalle_pedido = new DetallePedido();
                        $detalle_pedido->pedido_id = $pedido->id;
                        $detalle_pedido->producto_id = $producto->id;
                        $detalle_pedido->cantidad = $carrito_encontrado->qty;
                        $detalle_pedido->precio_unitario = $carrito_encontrado->price;
                        $detalle_pedido->sub_total = $carrito_encontrado->subtotal;
                        $detalle_pedido->save();
                    } else {
                        $detalle_pedido->update([
                            'pedido_id' => $pedido->id,
                            'producto_id' => $producto->id,
                            'cantidad' => $carrito_encontrado->qty,
                            'precio_unitario' => $carrito_encontrado->price,
                            'sub_total' => $carrito_encontrado->subtotal,
                        ]);
                    }
                }
            }
        } else {

            foreach (LaraCart::getItems() as $item) {

                $producto = CabeceraProducto::select('id')->where('codigo_producto', $item->id)->first();

                $detalle = DetallePedido::where('producto_id', $producto->id)->first();

                if (empty($detalle)) {
                    $detalle_pedido = new DetallePedido();
                    $detalle_pedido->pedido_id = $pedido->id;
                    $detalle_pedido->producto_id = $producto->id;
                    $detalle_pedido->cantidad = $item->qty;
                    $detalle_pedido->precio_unitario = $item->price;
                    $detalle_pedido->sub_total = $item->subtotal;
                    $detalle_pedido->save();
                } else {
                    $detalle->update([
                        'pedido_id' => $pedido->id,
                        'producto_id' => $producto->id,
                        'cantidad' => $item->qty,
                        'precio_unitario' => $item->price,
                        'sub_total' => $item->subtotal,
                    ]);
                }
            }
        }
        LaraCart::destroyCart();
        return responseJson('Actualizado', $pedido, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            $pedido = Pedido::find($request->pedido_id)->load('detalle_pedido');
            $pedido->detalle_pedido()->delete();
            $pedido->delete();
            if ($pedido->trashed()) {
                return responseJson('Eliminado Exitosamente', $pedido, 200);
            }
        } catch (\Exception $e) {
            return responseJson('Server Error', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ], 500);
        }
    }
}
