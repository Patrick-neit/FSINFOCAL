<?php

namespace App\Http\Controllers;

use App\Models\PuntoVenta;
use App\Models\Sucursal;
use App\Services\ImpuestoCuisService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PuntoVentaController extends Controller
{
    public function index()
    {
        $puntosVentas = PuntoVenta::where('empresa_id', Auth::user()->empresas[0]->id)->get();
        return view('puntos_ventas.index', compact('puntosVentas'));
    }

    public function create()
    {
        $sucursales = Sucursal::where('empresa_id', Auth::user()->empresas[0]->id)->get();
        return view('puntos_ventas.create', compact('sucursales'));

    }

    public function store(Request $request)
    {
        try {
            $codigoPuntoVenta = $request->tipo_punto_venta;
            $resCuis = (new ImpuestoCuisService())->obtenerCuisImpuestos($codigoPuntoVenta);

        } catch (\Exception $e) {
            return responseJson('Server Error',[
                'message'=> $e->getMessage(),
                'codde'=> $e->getCode(),
            ],500);
        }
    }
}
