<?php

namespace App\Http\Controllers;

use App\Models\CabeceraProducto;
use App\Models\CatalogoPrecioProducto;
use App\Models\Cliente;
use App\Models\ClienteTipoPrecio;
use DB;
use Illuminate\Http\Request;

class CatalogoPrecioProductoController extends Controller
{
    public function tipo_precio_index(){
        $tipoPreciosClientes = ClienteTipoPrecio::all();
        return view('catalogos_productos.tipo_precio_index', compact('tipoPreciosClientes'));
    }

    public function tipo_precio_create(){
        $clientes = Cliente::where('estado',1)->get();
        return view('catalogos_productos.tipo_precio_create', compact('clientes'));
    }

    public function index(){
        $clientesProductos = Cliente::whereHas('catalogos_precios_productos')->get();
        return view('catalogos_productos.index', compact('clientesProductos'));
    }

    public function create(){
        $clientes = Cliente::all();
        $productos = CabeceraProducto::all();
        return view('catalogos_productos.create', compact('clientes','productos'));
    }

    public function store(Request $request){
        try {
            $clienteID = $request->cliente_id;
            DB::beginTransaction();
            foreach ($request->productos as $producto) {
                $catalogo_precio = new CatalogoPrecioProducto();
                $catalogo_precio->tipo_precio_a = $producto['precio_a'];
                $catalogo_precio->tipo_precio_b = $producto['precio_b'];
                $catalogo_precio->tipo_precio_c = $producto['precio_c'];
                $catalogo_precio->tipo_precio_d = $producto['precio_d'];
                $catalogo_precio->producto_id = $producto['producto_id'];
                $catalogo_precio->cliente_id = $clienteID;
                $catalogo_precio->save();
            }
            DB::commit();
            return responseJson('Catalogo Precio Aasignado',$catalogo_precio ,200);
        } catch (\Exception $e) {
            DB::rollBack();
            return responseJson('Server Error', [
                'message' => $e->getMessage(),
            ], 500);
        }
    }


}
