<?php

namespace App\Http\Controllers;

use App\Http\Requests\CabeceraProductoStoreRequest;
use App\Models\Almacen;
use App\Models\CabeceraProducto;
use App\Models\Categoria;
use App\Models\DetallePedido;
use App\Models\DetalleProducto;
use App\Models\DosificacionEmpresa;
use App\Models\ImpuestoProductoServicio;
use App\Models\ImpuestoUnidadMedida;
use App\Models\InventarioAlmacen;
use App\Models\KardexProducto;
use App\Models\Marca;
use App\Models\SubFamilia;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use LukePOLO\LaraCart\Facades\LaraCart;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = [
            ['link' => 'home', 'name' => 'Home'],
            ['link' => 'javascript:void(0)', 'name' => 'Productos'],
        ];
        $pageConfigs = [
            'pageHeader' => true,
            'isFabButton' => true,
        ];

        return view('productos.index', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'productos' => CabeceraProducto::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumbs = [
            ['link' => 'home', 'name' => 'Home'],
            ['link' => 'producto/index', 'name' => 'Productos'],
            ['name' => 'Nuevo Producto'],
        ];
        $pageConfigs = [
            'pageHeader' => true,
            'isFabButton' => true,
        ];

        return view('productos.create', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'almacenes' => Almacen::all(),
            //'dosificaciones' => DosificacionEmpresa::all(),
            'dosificaciones' => DosificacionEmpresa::with('detalles_dosificaciones_empresas')->get(),
            'unidad_medidas' => ImpuestoUnidadMedida::all(),
            'marcas' => Marca::all(),
            'categorias' => Categoria::all(),
            'sub_familias' => SubFamilia::all(),
            'produto_servicios' => ImpuestoProductoServicio::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CabeceraProductoStoreRequest $request)
    {
        /* try { */
        if (! empty($request->producto_id)) {
            return $this->update($request);
        }

        $cabeceraProducto = new CabeceraProducto();
        $detalleProducto = new DetalleProducto();
        $inventarioAlmacen = new InventarioAlmacen();
        $kardexProducto = new KardexProducto();

        //aign valores de productos
        $cabeceraProducto->codigo_actividad = $request->dosificacion;

        $cabeceraProducto->unidad_medida_id = $request->unidad_medida;
        $cabeceraProducto->marca_id = $request->marca_id;
        $cabeceraProducto->categoria_id = $request->categoria;
        $cabeceraProducto->tipo_id = $request->tipo_producto;
        $cabeceraProducto->sub_familia_id = $request->sub_familia;
        $cabeceraProducto->codigo_producto = $request->codigo_producto;
        $cabeceraProducto->nombre_producto = $request->nombre_producto;
        $cabeceraProducto->codigo_producto_impuestos = $request->homologacion;
        $cabeceraProducto->modelo = $request->modelo;
        $cabeceraProducto->numero_serie = $request->numero_serie;
        $cabeceraProducto->numero_imei = $request->numero_imei;
        $cabeceraProducto->peso_unitario = $request->peso_unitario;
        $cabeceraProducto->codigo_barra = $request->codigo_barra;
        $cabeceraProducto->caracteristicas = $request->caracteristica;
        $cabeceraProducto->stock_minimo = $request->stock_minimo;
        $cabeceraProducto->stock_actual = $request->stock_actual;
        $cabeceraProducto->estado = $request->estado;
        $cabeceraProducto->save();
        DB::beginTransaction();
        //asign los valores de detalle producto
        $detalleProducto->producto_id = $cabeceraProducto->id;
        $detalleProducto->precio_compra = $request->precio_compra;
        $detalleProducto->precio_unitario = $request->precio_unitario;
        $detalleProducto->precio_unitario2 = $request->precio_unitario2;
        $detalleProducto->precio_unitario3 = $request->precio_unitario3;
        $detalleProducto->precio_unitario4 = $request->precio_unitario4;
        $detalleProducto->precio_paquete = $request->precio_paquete;
        $detalleProducto->precio_venta_dolar = $request->precio_dolar;
        $detalleProducto->save();

        //asign valores de inventario almacen
        $inventarioAlmacen->almacen_id = $request->almacen_id;
        $inventarioAlmacen->producto_id = $cabeceraProducto->id;
        $inventarioAlmacen->stock_actual = $request->stock_actual;
        $inventarioAlmacen->save();

        if ($request->tipo_producto == 1) {
            $kardexProducto->producto_id = $cabeceraProducto->id;
            $kardexProducto->fecha = Carbon::now()->format('Y-m-d');
            $kardexProducto->hora = Carbon::now()->format('H:m:s');
            $kardexProducto->doc_soporte = '000';
            $kardexProducto->tipo_movimiento = 'Saldo Inicial';
            $kardexProducto->cantidad_ingresos = 0;
            $kardexProducto->precio_unitario_ingresos = 0;
            $kardexProducto->total_ingresos = 0;
            $kardexProducto->cantidad_egresos = 0;
            $kardexProducto->precio_unitario_egresos = 0;
            $kardexProducto->total_egresos = 0;
            $kardexProducto->cantidad_saldo_actual = $request->stock_actual;
            $kardexProducto->promedio = $request->precio_compra;
            $kardexProducto->costo_total_saldo = $request->stock_actual * $request->precio_compra;
            $kardexProducto->utilidad = 0;
            $kardexProducto->usuario_id = auth()->user()->id;
            $kardexProducto->save();
        }
        DB::commit();

        return responseJson('Producto Guardado.', $cabeceraProducto, 200);
        /* } catch (\Exception $e) {
            DB::rollBack();
            return responseJson('Server Error', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ], 500);
        } */
    }

    public function getNextId()
    {
        $statement = DB::select("show table status like 'cabecera_productos'");

        return $statement[0]->Auto_increment;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $breadcrumbs = [
            ['link' => 'home', 'name' => 'Home'],
            ['link' => 'producto/index', 'name' => 'Productos'],
            ['name' => 'Editar Producto'],
        ];
        $pageConfigs = [
            'pageHeader' => true,
            'isFabButton' => true,
        ];

        return view('productos.create', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'cabecera_producto' => CabeceraProducto::find($id),
            'detalle_producto' => DetalleProducto::where('producto_id', $id)->first(),
            'inventario_almacen' => InventarioAlmacen::where('producto_id', $id)->first(),
            'almacenes' => Almacen::all(),
            'dosificaciones' => DosificacionEmpresa::all(),
            'unidad_medidas' => ImpuestoUnidadMedida::all(),
            'marcas' => Marca::all(),
            'categorias' => Categoria::all(),
            'sub_familias' => SubFamilia::all(),
            'produto_servicios' => ImpuestoProductoServicio::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {

            $cabeceraProducto = CabeceraProducto::find($request->producto_id);
            $detalleProducto = DetalleProducto::where('producto_id', $request->producto_id)->first();
            //aign valores de productos
            // $cabeceraProducto->dosificacion_id = 1/* $request->dosificacion */;
            $cabeceraProducto->unidad_medida_id = $request->unidad_medida;
            $cabeceraProducto->marca_id = $request->marca_id;
            $cabeceraProducto->categoria_id = $request->categoria;
            $cabeceraProducto->tipo_id = $request->tipo_producto;
            $cabeceraProducto->sub_familia_id = $request->sub_familia;
            $cabeceraProducto->codigo_producto = $request->codigo_producto;
            $cabeceraProducto->nombre_producto = $request->nombre_producto;
            $cabeceraProducto->codigo_producto_impuestos = $request->homologacion;
            $cabeceraProducto->modelo = $request->modelo;
            $cabeceraProducto->numero_serie = $request->numero_serie;
            $cabeceraProducto->numero_imei = $request->numero_imei;
            $cabeceraProducto->peso_unitario = $request->peso_unitario;
            $cabeceraProducto->codigo_barra = $request->codigo_barra;
            $cabeceraProducto->caracteristicas = $request->caracteristica;
            $cabeceraProducto->stock_minimo = $request->stock_minimo;
            $cabeceraProducto->stock_actual = $request->stock_actual;
            $cabeceraProducto->estado = $request->estado;
            $cabeceraProducto->save();

            //asign los valores de detalle producto
            $detalleProducto->producto_id = $cabeceraProducto->id;
            $detalleProducto->precio_compra = $request->precio_compra;
            $detalleProducto->precio_unitario = $request->precio_unitario;
            $detalleProducto->precio_unitario2 = $request->precio_unitario2;
            $detalleProducto->precio_unitario3 = $request->precio_unitario3;
            $detalleProducto->precio_unitario4 = $request->precio_unitario4;
            $detalleProducto->precio_paquete = $request->precio_paquete;
            $detalleProducto->precio_venta_dolar = $request->precio_dolar;
            $detalleProducto->save();

            return responseJson('Producto Actualizado.', $cabeceraProducto, 200);
        } catch (\Exception $e) {
            return responseJson('Server Error', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ], 500);
        }
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
            $cabeceraProducto = CabeceraProducto::find($request->producto_id);
            $detalleProducto = DetalleProducto::find($request->producto_id);
            $cabeceraProducto->delete();
            $detalleProducto->delete();
            if ($cabeceraProducto->trashed() && $detalleProducto->trashed()) {
                return responseJson('Eliminado Exitosamente', $cabeceraProducto, 200);
            } else {
                return responseJson('No Eliminado', $cabeceraProducto, 200);
            }
        } catch (\Exception $e) {
            return responseJson('Server Error', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ], 500);
        }
    }

    public function getActividadProducto(Request $request)
    {
        $impuestoProductosServicios = ImpuestoProductoServicio::where('codigo_actividad', $request->dosificacion_id)->get();

        if (! isset($impuestoProductosServicios)) {
            return responseJson('Fallo al obtener Productos Servicios', $impuestoProductosServicios, 400);
        }

        return responseJson('Productos Servicios', $impuestoProductosServicios, 200);
    }

    public function updateProductCart(Request $request)
    {
        $product = LaraCart::find(['id' => $request->codigo_producto]);

        if (LaraCart::find(['id' => $request->codigo_producto]) == null) {
            return responseJson('No se encontro el producto', $product, 400);
        }

        $product->qty = $request->cantidad;
        $product->price = $request->precio_unitario;
        $product->subtotal = $request->subtotal;

        return responseJson('Producto', LaraCart::subTotal(false), 200);
    }

    public function getAllDetalle()
    {
    }

    public function getAllCart(Request $request)
    {
        //cart_id es codigo de producto
        $detalle_cart = LaraCart::find(['id' => $request->cart_id]);

        $producto = CabeceraProducto::select('id')->where('codigo_producto', $detalle_cart->id)->first();

        $detalle_pedido = DetallePedido::where('producto_id', $producto->id)->first()->load('pedido', 'producto');

        LaraCart::removeItem($detalle_cart->getHash());

        return responseJson('Get all detalle', LaraCart::getItems(), 200);
    }

    public function getProductoNombre(Request $request)
    {
        $productoFound = CabeceraProducto::find($request->search)->load('detalle_producto');

        $productoFound->unidad_medida_id = ImpuestoUnidadMedida::where('codigo_clasificador', $productoFound->unidad_medida_id)->first()->descripcion;

        $productoFound->bandera = 0;

        if (isset($productoFound) && LaraCart::find(['id' => $productoFound->codigo_producto]) == null) {
            LaraCart::add(
                $productoFound->codigo_producto,
                $productoFound->nombre_producto,
                '1.00000',
                $productoFound->detalle_producto->precio_compra,
                [
                    'subtotal' => $productoFound->detalle_producto->precio_compra * 1,
                    'unidad_medida_literal' => $productoFound->unidad_medida_id,
                ],
                false,
                false
            );
            $productoFound->bandera = 1;
        }

        return responseJson('Producto', $productoFound, 200);
    }

    public function destroyProducto(Request $request)
    {
        $producto = LaraCart::find(['id' => $request->codigo_producto]);
        if ($producto) {
            LaraCart::removeItem($producto->getHash());
        }

        return responseJson('Producto', LaraCart::subTotal(false), 200);
    }
}
