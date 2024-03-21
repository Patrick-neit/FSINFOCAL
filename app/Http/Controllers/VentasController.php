<?php

namespace App\Http\Controllers;

use App\ModelRequest\Factura;
use App\Models\CabeceraProducto;
use App\Models\Cliente;
use App\Models\ImpuestoMetodoPago;
use App\Models\ImpuestoTipoMoneda;
use App\Models\Sucursal;
use App\Models\User;
use App\Services\ImpuestoConfigService;
use App\Services\ImpuestoEmitirFacturaService;
use App\Services\ImpuestoVerificarNitService;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use LukePOLO\LaraCart\Facades\LaraCart;

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
        //dd(LaraCart::getItems());
        $breadcrumbs = [
            ['link' => 'home', 'name' => 'Home'],
            ['link' => 'javascript:void(0)', 'name' => 'Ventas'],
            ['link' => 'ventas/index', 'name' => 'Crear Venta'],
        ];
        $pageConfigs = [
            'pageHeader' => true,
            'isFabButton' => true,
        ];

//dd(LaraCart::getAttribute('subTotal'));
        return view('ventas.create', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'clientes' => Cliente::all(),
            'cabecera_productos' => CabeceraProducto::all(),
            'tipo_moneda' => ImpuestoTipoMoneda::all(),
            'tipo_pago' => ImpuestoMetodoPago::all(),
            'detalle_productos' => Laracart::getItems(),
        ]);
    }

    public function store(Request $request)
    {

        try {
            DB::beginTransaction();
            //crear venta y detalle venta
            $dataFactura = $this->construirDataFactura($request);
            dd($dataFactura);
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
        $configService = new ImpuestoConfigService();
        $factura = new Factura();
        $user = auth()->user();
        $cliente = Cliente::find($dataFactura->cliente_id);
        $sucursal = Sucursal::find($dataFactura->sucursal_id);

        $factura->prop_general = [
            "codigoPuntoVenta" => 0,
            "cuis" => "{{cuis}}",
            "codigoControl" => "{{codigoControl}}",
            "cufd" => "{{cufd}}",
            "tipoFacturaDocumento" => 1,
            "to" => $cliente->correo
        ];

        $factura->facturas = [
            "cabecera" => [
            "nitEmisor" => "{{nit}}",
            "razonSocialEmisor" => "Empresa 1",
            "municipio" => "LA PAZ",
            "telefono" => $cliente->telefono,
            "numeroFactura" => 2,
            "cuf" => "{{cuf}}",
            "cufd" => "{{cufd}}",
            "codigoSucursal" => 0,
            "direccion" => $cliente->direccion,
            "codigoPuntoVenta" => 0,
            "fechaEmision" => Carbon::now()->format('Y-m-d\TH:i:s'),
            "nombreRazonSocial" => $cliente->nombre_cliente,
            "codigoTipoDocumentoIdentidad" => 1,
            "numeroDocumento" => "8399077015",
            "complemento" => empty($cliente->complemento) ? true : false,
            "codigoCliente" => $cliente->id,
            "codigoMetodoPago" => 1,
            "numeroTarjeta" => null,
            "montoTotal" => 7,
            "montoTotalSujetoIva"   => 7,
            "codigoMoneda" => "1",
            "tipoCambio" => "1",
            "montoTotalMoneda" => 7,
            "montoGiftCard" => "0.00",
            "descuentoAdicional" => "0",
            "leyenda" => "Ley N\u00b0 453: Los contratos de adhesi\u00f3n deben redactarse en t\u00e9rminos claros, comprensibles, legibles y deben informar todas las facilidades y limitaciones.",
            "usuario" => $user->name . " " . $user->apellidos ? $user->apellidos : "",
            "codigoDocumentoSector" => 1
        ],
        "detalle" => [
            [
                "actividadEconomica" =>  620920,
                "codigoProductoSin"=> 99100,
                "codigoProducto"=> "2",
                "descripcion"=> "Aros",
                "cantidad"=> "1",
                "unidadMedida"=> 42,
                "precioUnitario"=> "2",
                "montoDescuento"=> 0,
                "subTotal"=> "2",
                "numeroSerie"=> null,
                "numeroImei"=> null
            ],
            [
                "actividadEconomica"=> 620920,
                "codigoProductoSin"=> 99100,
                "codigoProducto"=> "1",
                "descripcion"=> "Producto Sony",
                "cantidad"=> "1",
                "unidadMedida"=> 40,
                "precioUnitario"=> "5",
                "montoDescuento"=> 0,
                "subTotal"=> "5",
                "numeroSerie"=> null,
                "numeroImei"=> null
            ]
        ]
            ];
            return $factura;
    }

    public function getDataCliente(Request $request)
    {
        try {
            $clienteID = $request->cliente_id;
            $cliente = Cliente::find($clienteID);

            if (!isset($cliente)) {
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
