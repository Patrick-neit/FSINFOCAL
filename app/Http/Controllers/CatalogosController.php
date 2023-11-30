<?php

namespace App\Http\Controllers;

use App\Models\ImpuestoDocumentoSector;
use App\Models\ImpuestoEventoSignificativo;
use App\Models\ImpuestoFechaHora;
use App\Models\ImpuestoMensajeServicio;
use App\Models\ImpuestoMotivoAnulacion;
use App\Models\ImpuestoTipoDocumentoSector;
use App\Models\ImpuestoTipoFactura;
use App\Models\ImpuestoTipoPuntoVenta;
use App\Services\ImpuestoSincronizarService;

class CatalogosController extends Controller
{
    protected $sincService;

    public function __construct()
    {
        $this->sincService = new ImpuestoSincronizarService();
    }

    public function index()
    {
        $impuestosFechaHora = ImpuestoFechaHora::all();

        return view('sincronizacion.fechahora', compact('impuestosFechaHora'));
    }

    public function indexAnulacion()
    {
        $motivoAnulaciones = ImpuestoMotivoAnulacion::all();

        return view('sincronizacion.motivoanulacion', compact('motivoAnulaciones'));
    }

    public function indexTipoDocSector()
    {
        $tipoDocumentoSector = ImpuestoTipoDocumentoSector::all();

        return view('sincronizacion.tipoDocumentoSector', compact('tipoDocumentoSector'));
    }

    public function indexDocumentoSector()
    {
        $documentoSector = ImpuestoDocumentoSector::all();

        return view('sincronizacion.documentoSector', compact('documentoSector'));
    }

    public function indexTiposFactura()
    {
        $tiposFactura = ImpuestoTipoFactura::all();

        return view('sincronizacion.tiposFactura', compact('tiposFactura'));
    }

    public function indexMensajesServicios()
    {
        $mensajesServicios = ImpuestoMensajeServicio::all();

        return view('sincronizacion.mensajesServicios', compact('mensajesServicios'));
    }

    public function indexEventos()
    {
        $eventosSignificativos = ImpuestoEventoSignificativo::all();

        return view('sincronizacion.eventosSignificativos', compact('eventosSignificativos'));
    }

    public function indexTipoPV()
    {
        $tipoPuntoVenta = ImpuestoTipoPuntoVenta::all();

        return view('sincronizacion.tipoPV', compact('tipoPuntoVenta'));
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
                case 'sincronizarParametricaMotivoAnulacion':
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
                    ImpuestoFechaHora::create([
                        'fecha_hora' => $dataSincronizar->content->fechaHora,
                        'transaccion' => $dataSincronizar->content->transaccion,
                    ]);
                    break;

                case 'sincronizarParametricaTipoDocumentoSector':
                    ImpuestoTipoDocumentoSector::truncate();
                    foreach ($dataSincronizar->content->listaCodigos as $sector) {
                        ImpuestoTipoDocumentoSector::create([
                            'codigo_clasificador' => $sector->codigoClasificador,
                            'descripcion' => $sector->descripcion,
                            'transaccion' => $dataSincronizar->content->transaccion,
                        ]);
                    }
                    break;
                case 'sincronizarListaActividadesDocumentoSector':
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
            }
        }

        return responseJson('Sincronizado', $dataSincronizar->content, 200);
    }
}
