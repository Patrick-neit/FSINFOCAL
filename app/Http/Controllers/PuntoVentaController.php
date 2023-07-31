<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use App\Models\PuntoVenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ImpuestoCuisService;

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

            $dataCuis = ([
                'tipo_punto_venta' => $request->tipo_punto_venta,
                'sucursal_id' => $request->sucursal_id,
            ]);

            $resCuis = (new ImpuestoCuisService())->obtenerCuisImpuestos($dataCuis);

        } catch (\Exception $e) {
            return responseJson('Server Error',[
                'message'=> $e->getMessage(),
                'code'=> $e->getCode(),
            ],500);
        }
    }
}
