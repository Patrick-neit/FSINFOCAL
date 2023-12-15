<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CabeceraProducto;
use App\Models\DetallePedido;
use App\Models\Pedido;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Carbon\Carbon;
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
            $detalle_pedido = new DetallePedido();
            $detalle_pedido->pedido_id = $pedido->id;
            $detalle_pedido->producto_id = CabeceraProducto::select('id')->where('codigo_producto', $item->id)->first()->id;
            $detalle_pedido->cantidad = $item->qty;
            $detalle_pedido->precio_unitario = $item->price;
            $detalle_pedido->sub_total = $item->subtotal;
            $detalle_pedido->save();
        }
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
