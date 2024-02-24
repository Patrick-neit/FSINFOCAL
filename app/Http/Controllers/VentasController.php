<?php

namespace App\Http\Controllers;

use App\Models\CabeceraProducto;
use App\Models\Cliente;
use App\Models\ImpuestoMetodoPago;
use App\Models\ImpuestoTipoMoneda;
use App\Models\Sucursal;
use App\Models\User;
use App\Services\ImpuestoEmitirFacturaService;
use App\Services\ImpuestoVerificarNitService;
use DB;
use Illuminate\Http\Request;

class VentasController extends Controller
{
    public $nitService;

    public $emitirService;

    public function __construct()
    {
        $this->nitService = new ImpuestoVerificarNitService();
        $this->emitirService = new ImpuestoEmitirFacturaService();
    }

    public function index()
    {
        $breadcrumbs = [
            ['link' => 'home', 'name' => 'Home'],
            ['link' => 'javascript:void(0)', 'name' => 'Ventas'],
        ];

        $pageConfigs = [
            'pageHeader' => true,
            'isFabButton' => true,
        ];

        return view('ventas.index', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'clientes' => Cliente::all(),
            'cabecera_productos' => CabeceraProducto::all(),
            'tipo_moneda' => ImpuestoTipoMoneda::all(),
            'tipo_pago' => ImpuestoMetodoPago::all(),
        ]);
    }

    public function create()
    {
        $breadcrumbs = [
            ['link' => 'home', 'name' => 'Home'],
            ['link' => 'javascript:void(0)', 'name' => 'Ventas'],
            ['link' => 'ventas/index', 'name' => 'Crear Venta'],
        ];
        $pageConfigs = [
            'pageHeader' => true,
            'isFabButton' => true,
        ];

        return view('ventas.create', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'clientes' => Cliente::all(),
            'cabecera_productos' => CabeceraProducto::all(),
            'tipo_moneda' => ImpuestoTipoMoneda::all(),
            'tipo_pago' => ImpuestoMetodoPago::all(),
        ]);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $dataFactura = $this->construirDataFactura($request);
            $dataFacturaCabecera = $dataFactura[0];
            $dataFacturaDetalle = $dataFactura[1];
            $enviarFactura = $this->emitirService->emitirFacturaImpuestos($dataFacturaCabecera, $dataFacturaDetalle);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return responseJson('Server Error', [
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function construirDataFactura($dataFactura)
    {
        $user = User::find($dataFactura->user_id);
        $cliente = Cliente::find($dataFactura->cliente_id);
        $sucursal = Sucursal::find($dataFactura->sucursal_id);

    }

    public function getDataCliente(Request $request)
    {
        try {
            $clienteID = $request->cliente_id;
            $cliente = Cliente::find($clienteID);
            dd($cliente);
            if (! isset($cliente)) {
                return responseJson('No Se Pudo Recuperar la info del Cliente', $cliente, 400);
            }
            if ($cliente->tipo_documento_id == 5) {
                $verificarNit = $this->nitService->verificarNit($cliente->numero_nit);
                if ($verificarNit->status == 200 && $verificarNit->content->transaccion == true) {
                    return responseJson('Data Cliente', [
                        'cliente' => [
                            'data_cliente' => $cliente,
                            'data_nit' => $verificarNit->content->descripcion,
                        ],
                    ], 200);
                } else {
                    return responseJson('Error Peticion Impuestos', $verificarNit, 400);
                }
            }

            return responseJson('Data Cliente', [
                'cliente' => [
                    'data_cliente' => $cliente,
                    'data_nit' => false,
                ],
            ], 200);
        } catch (\Exception $e) {
            return responseJson('Server Error', [
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
