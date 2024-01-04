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
    public function tipo_precio_index()
    {
        return view('catalogos_productos.tipo_precio_index', [
            'clientes' => Cliente::where('estado', 1)->get()
        ]);
    }

    public function tipo_precio_create()
    {
        $clientes = Cliente::where('estado', 1)->get();
        return view('catalogos_productos.tipo_precio_create', compact('clientes'));
    }

    public function tipo_precio_edit(Cliente $cliente)
    {
        return view('catalogos_productos.tipo_precio_edit', compact('cliente'));
    }

    public function tipo_precio_store(Request $request)
    {
        try {
            $cliente = Cliente::find($request->cliente_id);
            foreach ($request->productos as $producto) {
                $catalogo = CatalogoPrecioProducto::where('cliente_id', $request->cliente_id)
                    ->where('producto_id', $producto["producto_id"])
                    ->first();
                
                $catalogo->update([
                    'tipo_precio_a' => $producto["precio_a"],
                    'tipo_precio_b' => $producto["precio_b"],
                    'tipo_precio_c' => $producto["precio_c"],
                    'tipo_precio_d' => $producto["precio_d"],
                    'tipo_precio_e' => $producto["precio_e"],
                    'tipo_precio_f' => $producto["precio_f"],
                    'tipo_precio_g' => $producto["precio_g"],
                ]);
            }
            $cliente->tipo_precio = $request->tipos_precios;
            $cliente->save();
            return responseJson('Actualizado', $cliente, 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return responseJson('Server Error', [
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function index()
    {
        $clientes = Cliente::where('estado', 1)->get();
        $clientesProductos = Cliente::whereHas('catalogos_precios_productos')->get();
        $productos = CabeceraProducto::all();
        return view('catalogos_productos.index', compact('clientesProductos', 'clientes', 'productos'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $productos = CabeceraProducto::all();
        return view('catalogos_productos.create', compact('clientes', 'productos'));
    }

    public function store(Request $request)
    {
        try {
            $clienteID = $request->cliente_id;
            DB::beginTransaction();
            foreach ($request->productos as $producto) {
                $catalogo_precio = new CatalogoPrecioProducto();
                $catalogo_precio->tipo_precio_a = $producto['precio_a'];
                $catalogo_precio->tipo_precio_b = $producto['precio_b'];
                $catalogo_precio->tipo_precio_c = $producto['precio_c'];
                $catalogo_precio->tipo_precio_d = $producto['precio_d'];
                $catalogo_precio->tipo_precio_e = $producto['precio_e'];
                $catalogo_precio->tipo_precio_f = $producto['precio_f'];
                $catalogo_precio->tipo_precio_g = $producto['precio_g'];
                $catalogo_precio->producto_id = $producto['producto_id'];
                $catalogo_precio->cliente_id = $clienteID;
                $catalogo_precio->save();
            }
            DB::commit();
            return responseJson('Catalogo Precio Aasignado', $catalogo_precio, 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return responseJson('Server Error', [
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    public function updateClientePrecio(Request $request)
    {
        try {
            $cliente = Cliente::find($request->cliente_id);
            $cliente->tipo_precio = $request->tipos_precios;
            $cliente->save();

            $catalogos = CatalogoPrecioProducto::where('cliente_id', $request->cliente_id)->get();
            foreach ($catalogos as $catalogo) {
                switch ($request->tipos_precios) {
                    case 1:
                        $catalogo->update([
                            'tipo_precio_a' => 1,
                            'tipo_precio_b' => 0,
                            'tipo_precio_c' => 0,
                            'tipo_precio_d' => 0,
                            'tipo_precio_e' => 0,
                            'tipo_precio_f' => 0,
                            'tipo_precio_g' => 0,
                        ]);
                        break;
                    case 2:
                        $catalogo->update([
                            'tipo_precio_a' => 0,
                            'tipo_precio_b' => 1,
                            'tipo_precio_c' => 0,
                            'tipo_precio_d' => 0,
                            'tipo_precio_e' => 0,
                            'tipo_precio_f' => 0,
                            'tipo_precio_g' => 0,
                        ]);
                        break;
                    case 3:
                        $catalogo->update([
                            'tipo_precio_a' => 0,
                            'tipo_precio_b' => 0,
                            'tipo_precio_c' => 1,
                            'tipo_precio_d' => 0,
                            'tipo_precio_e' => 0,
                            'tipo_precio_f' => 0,
                            'tipo_precio_g' => 0,
                        ]);
                        break;
                    case 4:
                        $catalogo->update([
                            'tipo_precio_a' => 0,
                            'tipo_precio_b' => 0,
                            'tipo_precio_c' => 0,
                            'tipo_precio_d' => 1,
                            'tipo_precio_e' => 0,
                            'tipo_precio_f' => 0,
                            'tipo_precio_g' => 0,
                        ]);
                        break;
                    case 5:
                        $catalogo->update([
                            'tipo_precio_a' => 0,
                            'tipo_precio_b' => 0,
                            'tipo_precio_c' => 0,
                            'tipo_precio_d' => 0,
                            'tipo_precio_e' => 1,
                            'tipo_precio_f' => 0,
                            'tipo_precio_g' => 0,
                        ]);
                        break;
                    case 6:
                        $catalogo->update([
                            'tipo_precio_a' => 0,
                            'tipo_precio_b' => 0,
                            'tipo_precio_c' => 0,
                            'tipo_precio_d' => 0,
                            'tipo_precio_e' => 0,
                            'tipo_precio_f' => 1,
                            'tipo_precio_g' => 0,
                        ]);
                        break;
                    case 7:
                        $catalogo->update([
                            'tipo_precio_a' => 0,
                            'tipo_precio_b' => 0,
                            'tipo_precio_c' => 0,
                            'tipo_precio_d' => 0,
                            'tipo_precio_e' => 0,
                            'tipo_precio_f' => 0,
                            'tipo_precio_g' => 1,
                        ]);
                        break;
                }
            }

            return responseJson('Actualizado Tipo Precio', $cliente, 200);
        } catch (\Exception $e) {
            return responseJson('Server Error', [
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
