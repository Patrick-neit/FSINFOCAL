<?php

namespace App\Http\Controllers;

use App\Models\ImpuestoCuis;
use App\Models\ImpuestoTipoPuntoVenta;
use App\Models\PuntoVenta;
use App\Models\PuntoVentaCufd;
use App\Models\Sucursal;
use App\Services\ImpuestoCufdService;
use App\Services\ImpuestoCuisService;
use App\Services\ImpuestoRegistroPVService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PuntoVentaController extends Controller
{
    public $cuiService;

    public $cufdService;

    public $registrarPVImpuesto;

    public function __construct()
    {
        $this->cuiService = new ImpuestoCuisService();
        $this->cufdService = new ImpuestoCufdService();
        $this->registrarPVImpuesto = new ImpuestoRegistroPVService();
    }

    public function index()
    {
        $puntosVentas = PuntoVenta::where('empresa_id', Auth::user()->empresas[0]->id)->get();

        return view('puntos_ventas.index', compact('puntosVentas'));
    }

    public function create()
    {
        $sucursales = Sucursal::where('empresa_id', Auth::user()->empresas[0]->id)->get();
        $tipoPuntosVentas = ImpuestoTipoPuntoVenta::all();

        return view('puntos_ventas.create', compact('sucursales', 'tipoPuntosVentas'));
    }

    public function store(Request $request)
    {
        try {
            $userID = Auth::user()->id;
            $empresaID = Auth::user()->empresas[0]->id;
            $verificarPuntoVenta = verificarSiPuntoVenta($empresaID); //? Verifica si ya existe mas de 1 PV Registrado
            /* if (!$verificarPuntoVenta) { */
            $resPuntoVenta = $this->storePuntoVenta($request);
                if ($resPuntoVenta) {
                    return responseJson('Punto Venta Sincronizado Exitosamente', $resPuntoVenta, 200);
                } else {
                    return responseJson('Error al Sincronizar Punto Venta ', $resPuntoVenta, 500);
                }
           /*  } else {
                return responseJson('Ya Existe PV A Personal Asociado', $verificarPuntoVenta, 500);
            } */
        } catch (\Exception $e) {
            return responseJson('Server Error', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ], 500);
        }
    }

    public function storePuntoVenta($request)
    {
        try {
            $userID = Auth::user()->id;
            $empresaID = Auth::user()->empresas[0]->id;

            $dataService = json_decode(json_encode([
                'nombre_punto_venta' => $request->nombre_punto_venta,
                'descripcion_punto_venta' => $request->descripcion_punto_venta,
                'tipo_punto_venta' => $request->tipo_punto_venta,
                'sucursal_id' => $request->sucursal_id,
            ]));
            $sucursal = Sucursal::find($dataService->sucursal_id);

            $resCuis = $this->cuiService->obtenerCuisImpuestos($dataService);
            $resCodigoCuis = $resCuis->content->codigo;


            $resCufd = $this->cufdService->obtenerCufdImpuestos($dataService, $resCodigoCuis);

            if ($resCuis->content->mensajesList[0]->codigo != 980 || $resCufd->content->transaccion != true) {
                return responseJson('Error al Consumir Servicio', $resCuis->content->mensajesList->descripcion, 500);
            }
            $resExistePV = verificarPuntoVentaSucursal0($empresaID);
            if ($resExistePV) { //Si ya existe 1 PV creado
                $resCuisBD = ImpuestoCuis::where([
                    ['sucursal_id', $dataService->sucursal_id],
                    ['empresa_id', $empresaID]
                ])->orderBy('fecha_vencimiento', 'DESC')
                ->first();

                $resRegistroPV = $this->registrarPVImpuesto->registrarPVImpuesto($dataService, $resCuisBD->codigo_cuis);
                if ($resRegistroPV->status != 200) {
                    if ($resRegistroPV->content->mensajesList[0]->codigo != 980 || $resRegistroPV->content->transaccion != true) {
                        return responseJson('Algo salio mal', $resRegistroPV->content->mensajesList[0]->descripcion, 500);
                    }

                }
            }

            DB::beginTransaction();
            $registrarPuntoVenta = new PuntoVenta();
            $registrarPuntoVenta->nombre_punto_venta = $request->nombre_punto_venta;
            $registrarPuntoVenta->tipo_punto_venta = ! isset($request->tipo_punto_venta) ? 0 : $request->tipo_punto_venta;
            $registrarPuntoVenta->codigo_punto_venta = ! isset($request->tipo_punto_venta) ? 0 : $resRegistroPV->content->codigoPuntoVenta; //todo
            $registrarPuntoVenta->descripcion_punto_venta = $request->descripcion_punto_venta;

            $registrarPuntoVenta->sucursal_id = $request->sucursal_id;
            $registrarPuntoVenta->empresa_id = Auth::user()->empresas[0]->id;
            $registrarPuntoVenta->save();

            $registrarCuis = (new ImpuestoCuisController())->store($resCuis, $dataService);
            $registrarCufd = (new ImpuestoCufdController())->store($resCufd, $dataService);

            $registrarPuntoVentaCufd = new PuntoVentaCufd();
            $registrarPuntoVentaCufd->cuis_id = $registrarCuis;
            $registrarPuntoVentaCufd->cufd_id = $registrarCufd;
            $registrarPuntoVentaCufd->punto_venta_id = $registrarPuntoVenta->id;
            $registrarPuntoVentaCufd->save();

            DB::commit();

            return $registrarPuntoVentaCufd->save() ? true : false;
        } catch (\Exception $e) {
            DB::rollback();

            return responseJson('Server Error', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ], 500);
        }
    }
}
