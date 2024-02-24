<?php

namespace App\Http\Controllers;

use App\Models\ImpuestoDocumentoIdentidad;
use App\Models\ImpuestoDocumentoSector;
use App\Models\ImpuestoEventoSignificativo;
use App\Models\ImpuestoFechaHora;
use App\Models\ImpuestoLeyendaFactura;
use App\Models\ImpuestoListadoActividad;
use App\Models\ImpuestoListadoPais;
use App\Models\ImpuestoMensajeServicio;
use App\Models\ImpuestoMetodoPago;
use App\Models\ImpuestoMotivoAnulacion;
use App\Models\ImpuestoProductoServicio;
use App\Models\ImpuestoTipoDocumentoSector;
use App\Models\ImpuestoTipoEmision;
use App\Models\ImpuestoTipoFactura;
use App\Models\ImpuestoTipoHabitacion;
use App\Models\ImpuestoTipoMoneda;
use App\Models\ImpuestoTipoPuntoVenta;
use App\Models\ImpuestoUnidadMedida;
use App\Services\ImpuestoSincronizarService;
use Illuminate\Support\Facades\Log;

class CatalogosController extends Controller
{
    protected $sincService;

    public function __construct()
    {
        $this->sincService = new ImpuestoSincronizarService();
    }

    public function index2()
    {
        $breadcrumbs = [
            ['link' => 'home', 'name' => 'Home'],
            ['link' => 'javascript:void(0)', 'name' => 'Catalogos de Impuestos'],
        ];
        $pageConfigs = [
            'pageHeader' => true,
            'isFabButton' => true,
        ];
        $motivoAnulaciones = ImpuestoMotivoAnulacion::all();
        $impuestosFechaHora = ImpuestoFechaHora::all();
        $tipoDocumentoSector = ImpuestoTipoDocumentoSector::all();
        $documentoSector = ImpuestoDocumentoSector::all();
        $tiposFactura = ImpuestoTipoFactura::all();
        $mensajesServicios = ImpuestoMensajeServicio::all();
        $eventosSignificativos = ImpuestoEventoSignificativo::all();
        $tipoPuntoVenta = ImpuestoTipoPuntoVenta::all();
        $productosServicios = ImpuestoProductoServicio::all();
        $tipoMonedas = ImpuestoTipoMoneda::all();
        $actividades = ImpuestoListadoActividad::all();
        $tipoEmisiones = ImpuestoTipoEmision::all();
        $tipoDocumentoIdentidad = ImpuestoDocumentoIdentidad::all();
        $leyendasFactura = ImpuestoLeyendaFactura::all();
        $metodosPagos = ImpuestoMetodoPago::all();
        $unidadMedida = ImpuestoUnidadMedida::all();
        $paises = ImpuestoListadoPais::all();
        $tipoHabitacion = ImpuestoTipoHabitacion::all();

        return view('sincronizacion.index', [
            'impuestosFechaHora' => $impuestosFechaHora,
            'motivoAnulaciones' => $motivoAnulaciones,
            'tipoDocumentoSector' => $tipoDocumentoSector,
            'documentoSector' => $documentoSector,
            'tiposFactura' => $tiposFactura,
            'mensajesServicios' => $mensajesServicios,
            'eventosSignificativos' => $eventosSignificativos,
            'tipoPuntoVenta' => $tipoPuntoVenta,
            'productosServicios' => $productosServicios,
            'tipoMonedas' => $tipoMonedas,
            'actividades' => $actividades,
            'tipoEmisiones' => $tipoEmisiones,
            'tipoDocumentoIdentidad' => $tipoDocumentoIdentidad,
            'leyendasFactura' => $leyendasFactura,
            'metodosPagos' => $metodosPagos,
            'unidadMedida' => $unidadMedida,
            'paises' => $paises,
            'tipoHabitacion' => $tipoHabitacion,
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    public function index($sincronizacion)
    {
        switch ($sincronizacion) {
            case 'sincronizacion_fecha_hora':
                $impuestosFechaHora = ImpuestoFechaHora::all();
                $view = 'sincronizacion.fechahora';
                $params = 'impuestosFechaHora';
                break;
            case 'sincronizacion_motivo_anulaciones':
                $motivoAnulaciones = ImpuestoMotivoAnulacion::all();
                $view = 'sincronizacion.motivoanulacion';
                $params = 'motivoAnulaciones';
                break;
            case 'sincronizacion_tipo_documento_sector':
                $tipoDocumentoSector = ImpuestoTipoDocumentoSector::all();
                $view = 'sincronizacion.tipodocumentosector';
                $params = 'tipoDocumentoSector';
                break;
            case 'sincronizacion_documento_sector':
                $documentoSector = ImpuestoDocumentoSector::all();
                $view = 'sincronizacion.documentosector';
                $params = 'documentoSector';
                break;
            case 'sincronizacion_tipos_factura':
                $tiposFactura = ImpuestoTipoFactura::all();
                $view = 'sincronizacion.tiposfactura';
                $params = 'tiposFactura';
                break;
            case 'sincronizacion_mensajes_servicios':
                $mensajesServicios = ImpuestoMensajeServicio::all();
                $view = 'sincronizacion.mensajesServicios';
                $params = 'mensajesServicios';
                break;
            case 'sincronizacion_eventos_significativos':
                $eventosSignificativos = ImpuestoEventoSignificativo::all();
                $view = 'sincronizacion.eventosSignificativos';
                $params = 'eventosSignificativos';
                break;
            case 'sincronizacion_tipo_puntoventa':
                $tipoPuntoVenta = ImpuestoTipoPuntoVenta::all();
                $view = 'sincronizacion.tipoPV';
                $params = 'tipoPuntoVenta';
                break;
            case 'sincronizacion_productos_servicios':
                $productosServicios = ImpuestoProductoServicio::all();
                $view = 'sincronizacion.productosServicios';
                $params = 'productosServicios';
                break;
            case 'sincronizacion_tipo_moneda':
                $tipoMonedas = ImpuestoTipoMoneda::all();
                $view = 'sincronizacion.tipoMoneda';
                $params = 'tipoMonedas';
                break;
            case 'sincronizacion_actividades':
                $actividades = ImpuestoListadoActividad::all();
                $view = 'sincronizacion.listadoActividades';
                $params = 'actividades';
                break;
            case 'sincronizacion_tipo_emision':
                $tipoEmisiones = ImpuestoTipoEmision::all();
                $view = 'sincronizacion.tipoEmision';
                $params = 'tipoEmisiones';
                break;
            case 'sincronizacion_tipo_documento_identidad':
                $tipoDocumentoIdentidad = ImpuestoDocumentoIdentidad::all();
                $view = 'sincronizacion.tipodocumentoidentidad';
                $params = 'tipoDocumentoIdentidad';
                break;
            case 'sincronizacion_leyendas_factura':
                $leyendasFactura = ImpuestoLeyendaFactura::all();
                $view = 'sincronizacion.leyendasFacturas';
                $params = 'leyendasFactura';
                break;
            case 'sincronizacion_metodos_pago':
                $metodosPagos = ImpuestoMetodoPago::all();
                $view = 'sincronizacion.metodosPagos';
                $params = 'metodosPagos';
                break;
            case 'sincronizacion_unidades_medida':
                $unidadMedida = ImpuestoUnidadMedida::all();
                $view = 'sincronizacion.unidadMedida';
                $params = 'unidadMedida';
                break;
            case 'sincronizacion_paises_origen':
                $paises = ImpuestoListadoPais::all();
                $view = 'sincronizacion.paisOrigen';
                $params = 'paises';
                break;
            case 'sincronizacion_tipo_habitacion':
                $tipoHabitacion = ImpuestoTipoHabitacion::all();
                $view = 'sincronizacion.tipoHabitacion';
                $params = 'tipoHabitacion';
                break;
        }

        return view($view, compact($params));
    }

    public function sincronizarCatalogos($accion)
    {
        $dataSincronizar = json_decode(json_encode([
            'codigoSucursal' => 0,
            'codigoPuntoVenta' => 0,
            'cuis' => '49DC0A17',
        ]));
        $dataSincronizar = $this->sincService->sincronizarServices($dataSincronizar, $accion);
        if ($dataSincronizar->content->transaccion) {
            switch ($accion) {
                case config('sistema.sincMotivoAnulacion'):
                    ImpuestoMotivoAnulacion::truncate();
                    foreach ($dataSincronizar->content->listaCodigos as $motivo) {
                        ImpuestoMotivoAnulacion::create([
                            'codigo_clasificador' => $motivo->codigoClasificador,
                            'descripcion' => $motivo->descripcion,
                            'transaccion' => $dataSincronizar->content->transaccion,
                        ]);
                    }
                    break;

                case config('sistema.sincFechaHora'):
                    ImpuestoFechaHora::truncate();
                    Log::info($dataSincronizar->content->transaccion);
                    ImpuestoFechaHora::create([
                        'fecha_hora' => $dataSincronizar->content->fechaHora,
                        'transaccion' => $dataSincronizar->content->transaccion,
                    ]);
                    break;

                case config('sistema.sincTipoDocumentoSector'):
                    ImpuestoTipoDocumentoSector::truncate();
                    foreach ($dataSincronizar->content->listaCodigos as $sector) {
                        ImpuestoTipoDocumentoSector::create([
                            'codigo_clasificador' => $sector->codigoClasificador,
                            'descripcion' => $sector->descripcion,
                            'transaccion' => $dataSincronizar->content->transaccion,
                        ]);
                    }
                    break;
                case config('sistema.sincActividadesDocumentoSector'):
                    ImpuestoDocumentoSector::truncate();
                    foreach ($dataSincronizar->content->listaActividadesDocumentoSector as $sector) {
                        ImpuestoDocumentoSector::create([
                            'codigo_actividad' => $sector->codigoActividad,
                            'codigo_documento_sector' => $sector->codigoDocumentoSector,
                            'tipo_documento_sector' => $sector->tipoDocumentoSector,
                            'transaccion' => $dataSincronizar->content->transaccion,
                        ]);
                    }
                    break;
                case config('sistema.sincTiposFactura'):
                    ImpuestoTipoFactura::truncate();
                    foreach ($dataSincronizar->content->listaCodigos as $sector) {
                        ImpuestoTipoFactura::create([
                            'codigo_clasificador' => $sector->codigoClasificador,
                            'descripcion' => $sector->descripcion,
                            'transaccion' => $dataSincronizar->content->transaccion,
                        ]);
                    }
                    break;
                case config('sistema.sincMensajesServicios'):
                    ImpuestoMensajeServicio::truncate();
                    foreach ($dataSincronizar->content->listaCodigos as $sector) {
                        ImpuestoMensajeServicio::create([
                            'codigo_clasificador' => $sector->codigoClasificador,
                            'descripcion' => $sector->descripcion,
                            'transaccion' => $dataSincronizar->content->transaccion,
                        ]);
                    }
                    break;
                case config('sistema.sincEventosSignificativos'):
                    ImpuestoEventoSignificativo::truncate();
                    foreach ($dataSincronizar->content->listaCodigos as $sector) {
                        ImpuestoEventoSignificativo::create([
                            'codigo_clasificador' => $sector->codigoClasificador,
                            'descripcion' => $sector->descripcion,
                            'transaccion' => $dataSincronizar->content->transaccion,
                        ]);
                    }
                    break;
                case config('sistema.sincTipoPV'):
                    ImpuestoTipoPuntoVenta::truncate();
                    foreach ($dataSincronizar->content->listaCodigos as $sector) {
                        ImpuestoTipoPuntoVenta::create([
                            'codigo_clasificador' => $sector->codigoClasificador,
                            'descripcion' => $sector->descripcion,
                            'transaccion' => $dataSincronizar->content->transaccion,
                        ]);
                    }
                    break;
                case config('sistema.sincProductosServicios'):
                    ImpuestoProductoServicio::truncate();
                    foreach ($dataSincronizar->content->listaCodigos as $sector) {
                        ImpuestoProductoServicio::create([
                            'codigo_actividad' => $sector->codigoActividad,
                            'codigo_producto' => $sector->codigoProducto,
                            'descripcion_producto' => $sector->descripcionProducto,
                            'nandina' => isset($sector->nandina) ? json_encode($sector->nandina) : null,
                            'transaccion' => $dataSincronizar->content->transaccion,
                        ]);
                    }
                    break;
                case config('sistema.sincTipoMoneda'):
                    ImpuestoTipoMoneda::truncate();
                    foreach ($dataSincronizar->content->listaCodigos as $sector) {
                        ImpuestoTipoMoneda::create([
                            'codigo_clasificador' => $sector->codigoClasificador,
                            'descripcion' => $sector->descripcion,
                            'transaccion' => $dataSincronizar->content->transaccion,
                        ]);
                    }
                    break;
                case config('sistema.sincActividades'):
                    ImpuestoListadoActividad::truncate();
                    foreach ($dataSincronizar->content->listaActividades as $sector) {
                        ImpuestoListadoActividad::create([
                            'codigo_caeb' => $sector->codigoCaeb,
                            'descripcion' => $sector->descripcion,
                            'tipo_actividad' => $sector->tipoActividad,
                            'transaccion' => $dataSincronizar->content->transaccion,
                        ]);
                    }
                    break;
                case config('sistema.sincTipoEmision'):
                    ImpuestoTipoEmision::truncate();
                    foreach ($dataSincronizar->content->listaCodigos as $sector) {
                        ImpuestoTipoEmision::create([
                            'codigo_clasificador' => $sector->codigoClasificador,
                            'descripcion' => $sector->descripcion,
                            'transaccion' => $dataSincronizar->content->transaccion,
                        ]);
                    }
                    break;
                case config('sistema.sincTipoDocumentoIdentidad'):
                    ImpuestoDocumentoIdentidad::truncate();
                    foreach ($dataSincronizar->content->listaCodigos as $sector) {
                        ImpuestoDocumentoIdentidad::create([
                            'codigo_clasificador' => $sector->codigoClasificador,
                            'descripcion' => $sector->descripcion,
                            'transaccion' => $dataSincronizar->content->transaccion,
                        ]);
                    }
                    break;
                case config('sistema.sincLeyendas'):
                    ImpuestoLeyendaFactura::truncate();
                    foreach ($dataSincronizar->content->listaLeyendas as $sector) {
                        ImpuestoLeyendaFactura::create([
                            'codigo_actividad' => $sector->codigoActividad,
                            'descripcion_leyenda' => $sector->descripcionLeyenda,
                            'transaccion' => $dataSincronizar->content->transaccion,
                        ]);
                    }
                    break;
                case config('sistema.sincTipoMetodoPago'):
                    ImpuestoMetodoPago::truncate();
                    foreach ($dataSincronizar->content->listaCodigos as $sector) {
                        ImpuestoMetodoPago::create([
                            'codigo_clasificador' => $sector->codigoClasificador,
                            'descripcion' => $sector->descripcion,
                            'transaccion' => $dataSincronizar->content->transaccion,
                        ]);
                    }
                    break;
                case config('sistema.sincUnidadMedida'):
                    ImpuestoUnidadMedida::truncate();
                    foreach ($dataSincronizar->content->listaCodigos as $sector) {
                        ImpuestoUnidadMedida::create([
                            'codigo_clasificador' => $sector->codigoClasificador,
                            'descripcion' => $sector->descripcion,
                            'transaccion' => $dataSincronizar->content->transaccion,
                        ]);
                    }
                    break;
                case config('sistema.sincPaisOrigen'):
                    ImpuestoListadoPais::truncate();
                    foreach ($dataSincronizar->content->listaCodigos as $sector) {
                        ImpuestoListadoPais::create([
                            'codigo_clasificador' => $sector->codigoClasificador,
                            'descripcion' => $sector->descripcion,
                            'transaccion' => $dataSincronizar->content->transaccion,
                        ]);
                    }
                    break;
                case config('sistema.sincTipoHabitacion'):
                    ImpuestoTipoHabitacion::truncate();
                    foreach ($dataSincronizar->content->listaCodigos as $sector) {
                        ImpuestoTipoHabitacion::create([
                            'codigo_clasificador' => $sector->codigoClasificador,
                            'descripcion' => $sector->descripcion,
                            'transaccion' => $dataSincronizar->content->transaccion,
                        ]);
                    }
                    break;
            }
        }

        return responseJson('Sincronizado', $dataSincronizar->content, 200);
    }
}
