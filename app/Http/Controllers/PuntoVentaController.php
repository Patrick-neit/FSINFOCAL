<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use App\Models\PuntoVenta;
use App\Services\ImpuestoCufdService;
use App\Services\ImpuestoCuisService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PuntoVentaController extends Controller
{
    public $cuiService;
    public $cufdService;

    public function __construct()
    {
        $this->cuiService = new ImpuestoCuisService();
        $this->cufdService = new ImpuestoCufdService();
    }

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

            $dataService = json_decode(json_encode([
                'tipo_punto_venta' => $request->tipo_punto_venta,
                'sucursal_id' => $request->sucursal_id,
            ]));

            $resCuis = $this->cuiService->obtenerCuisImpuestos($dataService);
            $resCodigoCuis = $resCuis->content->codigo;
            $resCufd = $this->cufdService->obtenerCufdImpuestos($dataService, $resCodigoCuis);

            if ($resCuis->content->mensajesList->codigo != 980 || $resCufd->content->RespuestaCufd->transaccion != true) {
                return responseJson('Error al Consumir Servicio', $resCuis->content->mensajesList->descripcion, 500);
            }
            DB::beginTransaction();
            $registrarPuntoVenta = new PuntoVenta();
            $registrarPuntoVenta->nombrePuntoVenta = $request->nombre_punto_venta;
            $registrarPuntoVenta->tipo_punto_venta = !isset($request->tipo_punto_venta) ? 0 : $request->tipo_punto_venta;
            $registrarPuntoVenta->codigo_punto_venta = $request->codigo_punto_venta;
            $registrarPuntoVenta->descripcion_punto_venta = $request->descripcion_punto_venta;
            $registrarPuntoVenta->sucursal_id = $request->sucursal_id;
            $registrarPuntoVenta->empresa_id = Auth::user()->empresas[0]->id;
            $registrarPuntoVenta->save();

            $registrarCuis = (new ImpuestoCuisController())->store($resCuis, $dataService);
            $registrarCufd = (new ImpuestoCufdController())->store($resCufd,$dataService);
            DB::commit();







        } catch (\Exception $e) {
            DB::rollback();
            return responseJson('Server Error', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ], 500);
        }
    }
}
