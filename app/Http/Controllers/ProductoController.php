<?php

namespace App\Http\Controllers;

use App\Models\CabeceraProducto;
use App\Models\Categoria;
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

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('productos.index', [
            'productos' => CabeceraProducto::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dosificaciones = DosificacionEmpresa::with('detalles_dosificaciones_empresas')->get();

        return view('productos.create', [
            'dosificaciones' => $dosificaciones,
            'unidad_medidas' => ImpuestoUnidadMedida::all(),
            'marcas' => Marca::all(),
            'categorias' => Categoria::all(),
            'sub_familias' => SubFamilia::all(),
            'produto_servicios' => ImpuestoProductoServicio::all()
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
        $requestHeader = $request->all();
        $cabeceraProducto = new CabeceraProducto();
        $detalleProducto = new DetalleProducto();
        $inventarioAlmacen = new InventarioAlmacen();
        $kardexProducto = new KardexProducto();

        //aign valores de productos
        $cabeceraProducto->dosificacion_id = 10000 /* $request->codigo_actividad */;
        /* $cabeceraProducto->codigo_producto_sin = 20000 *//* $request->codigo_producto_sin */;

        $cabeceraProducto->unidad_medida_id = $request->unidad_medida;
        $cabeceraProducto->marca_id = 1/*  $request->marca_id */;
        $cabeceraProducto->categoria_id = 1/* $request->categoria */;
        $cabeceraProducto->tipo_id = 1 /* $request->tipo_producto */;
        $cabeceraProducto->sub_familia_id = 1/*  $request->sub_familia */;
        $cabeceraProducto->codigo_producto =  10000/* $request->codigo_producto */;
        $cabeceraProducto->nombre_producto = $request->nombre_producto;
        $cabeceraProducto->codigo_producto_impuestos =  10000/* $request->homologacion */;
        $cabeceraProducto->modelo = $request->modelo;
        $cabeceraProducto->numero_serie = $request->numero_serie;
        $cabeceraProducto->numero_imei = $request->numero_imei;
        $cabeceraProducto->precio_unitario = $request->precio_unitario;
        $cabeceraProducto->codigo_barra = $request->codigo_barra;
        $cabeceraProducto->caracteristicas = $request->caracteristicas;
        $cabeceraProducto->stock_minimo = $request->stock_minimo;
        $cabeceraProducto->estado = $request->estado;
        $cabeceraProducto->save();

        //asign los valores de detalle producto
        $detalleProducto->producto_id = $cabeceraProducto->id;
        $detalleProducto->precio_compra = $request->precio_compra;
        $detalleProducto->precio_unitario = $request->precio_unitarioo;
        $detalleProducto->precio_unitario2 = $request->precio_unitario2;
        $detalleProducto->precio_unitario3 = $request->precio_unitario3;
        $detalleProducto->precio_unitario4 = $request->precio_unitario4;
        $detalleProducto->precio_paquete = $request->precio_paquete;
        $detalleProducto->precio_venta_dolar = $request->precio_dolar;
        $detalleProducto->save();

        //asign valores de inventario almacen
        $inventarioAlmacen->almacen_id = 1;
        $inventarioAlmacen->producto_id = 1;
        $inventarioAlmacen->save();

        if ($request->tipo_producto == 1) {
            $kardexProducto->producto_id = $cabeceraProducto->id;
            $kardexProducto->fecha = Carbon::now()->format('Y-m-d');
            $kardexProducto->hora = Carbon::now()->format('HH:mm:ss');
            $kardexProducto->doc_soporte = 'asdasd';
            $kardexProducto->tipo_movimiento = 'asdasd';
            $kardexProducto->save();
        }

        return responseJson('Producto Guardado.', $cabeceraProducto, 200);
    }

    public function getNextId()
    {
        $statement = DB::select("show table status like 'cabecera_productos'");

        return $statement[0]->Auto_increment;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function destroy($id)
    {
        //
    }
}
