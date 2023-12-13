<?php

namespace App\Http\Controllers;

use App\Http\Requests\CabeceraProductoStoreRequest;
use App\Models\Almacen;
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
            'almacenes' => Almacen::all(),
            'dosificaciones' => DosificacionEmpresa::all(),
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
    public function store(CabeceraProductoStoreRequest $request)
    {
        /* try { */
        if (!empty($request->producto_id)) {
            return $this->update($request);
        }

        $cabeceraProducto = new CabeceraProducto();
        $detalleProducto = new DetalleProducto();
        $inventarioAlmacen = new InventarioAlmacen();
        $kardexProducto = new KardexProducto();

        //aign valores de productos
        $cabeceraProducto->dosificacion_id = 10000 /* $request->codigo_actividad */;
            /* $cabeceraProducto->codigo_producto_sin = 20000 *//* $request->codigo_producto_sin */;

        $cabeceraProducto->unidad_medida_id = $request->unidad_medida;
        $cabeceraProducto->marca_id = $request->marca_id;
        $cabeceraProducto->categoria_id = $request->categoria;
        $cabeceraProducto->tipo_id =  $request->tipo_producto;
        $cabeceraProducto->sub_familia_id =  $request->sub_familia;
        $cabeceraProducto->codigo_producto =  $request->codigo_producto;
        $cabeceraProducto->nombre_producto = $request->nombre_producto;
        $cabeceraProducto->codigo_producto_impuestos =  $request->homologacion;
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
            $kardexProducto->tipo_movimiento = 'Ingreso Almacen';
            $kardexProducto->cantidad_ingresos = 0; //satock actua
            $kardexProducto->precio_unitario_ingresos = $request->precio_unitario;
            $kardexProducto->total_ingresos = 0; //cantdad * precio
            $kardexProducto->cantidad_egresos = 0;
            $kardexProducto->precio_unitario_egresos = 0;
            $kardexProducto->total_egresos = 0;
            $kardexProducto->cantidad_saldo_actual = $kardexProducto->cantidad_ingresos - $kardexProducto->cantidad_egresos;
            $kardexProducto->promedio = 0;
            $kardexProducto->costo_total_saldo = $kardexProducto->total_ingresos - $kardexProducto->total_egresos;
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
        return view('productos.create', [
            'cabecera_producto' => CabeceraProducto::find($id),
            'detalle_producto' => DetalleProducto::where('producto_id', $id)->first(),
            'inventario_almacen' => InventarioAlmacen::where('producto_id', $id)->first(),
            'almacenes' => Almacen::all(),
            'dosificaciones' => DosificacionEmpresa::all(),
            'unidad_medidas' => ImpuestoUnidadMedida::all(),
            'marcas' => Marca::all(),
            'categorias' => Categoria::all(),
            'sub_familias' => SubFamilia::all(),
            'produto_servicios' => ImpuestoProductoServicio::all()
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
        try {

            $cabeceraProducto = CabeceraProducto::find($request->producto_id);
            $detalleProducto = DetalleProducto::where('producto_id', $request->producto_id)->first();
            //aign valores de productos
            $cabeceraProducto->dosificacion_id = 1/* $request->dosificacion */;
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
            $cabeceraProducto->caracteristicas = $request->caracteristicas;
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
}
