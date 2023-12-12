<?php

namespace App\Http\Controllers;

use App\Models\CabeceraProducto;
use App\Models\Cliente;
use App\Models\ClienteTipoPrecio;
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

    public function create(){
        $clientes = Cliente::all();
        $productos = CabeceraProducto::all();
        return view('catalogos_productos.create', compact('clientes','productos'));
    }
}
