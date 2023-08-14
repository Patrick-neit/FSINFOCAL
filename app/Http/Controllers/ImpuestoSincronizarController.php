<?php

namespace App\Http\Controllers;

use App\Models\ImpuestoDocumentoIdentidad;
use App\Models\ImpuestoEventoSignificativo;
use App\Models\ImpuestoLeyendaFactura;
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

class ImpuestoSincronizarController extends Controller
{
    private $sincronizar;

    public function __construct()
    {
        $this->sincronizar = new ImpuestoSincronizarService();
    }
    public function storeParametricaMotivoAnulacion($dataSincronizar)
    {
        $resMotivoAnulacion =  $this->sincronizar->sincronizarParametricaMotivoAnulacion($dataSincronizar);
        $cantidadRegistrosBD = ImpuestoMotivoAnulacion::count();
        $cantidadMotivosAnulaciones = count($resMotivoAnulacion->content->listaCodigos);

        $motivosAnulaciones = $resMotivoAnulacion->content->listaCodigos;
        if ($cantidadRegistrosBD < $cantidadMotivosAnulaciones) {
            foreach ($motivosAnulaciones as $motivoAnulacion) {
                ImpuestoMotivoAnulacion::create([
                    'codigo_clasificador' => $motivoAnulacion->codigoClasificador,
                    'descripcion' => $motivoAnulacion->descripcion
                ]);
            }
        }
    }

    public function storeActividadesDocumentoSector($dataSincronizar) //check
    {
        $resActividadDocSector =  $this->sincronizar->sincronizarListaActividadesDocumentoSector($dataSincronizar);
    }

    public function storeParametricaTipoDocumentoSector($dataSincronizar)
    {
        $resParametricaDocSector =  $this->sincronizar->sincronizarParametricaTipoDocumentoSector($dataSincronizar);
        $cantidadRegistrosBD = ImpuestoTipoDocumentoSector::count();
        $cantidadTipoDocumentoSector = count($resParametricaDocSector->content->listaCodigos);
        $tiposDocumentosSectores = $resParametricaDocSector->content->listaCodigos;
        if ($cantidadRegistrosBD < $cantidadTipoDocumentoSector) {
            foreach ($tiposDocumentosSectores as $tipoDocumentoSector) {
                ImpuestoTipoDocumentoSector::create([
                    'codigo_clasificador' => $tipoDocumentoSector->codigoClasificador,
                    'descripcion' => $tipoDocumentoSector->descripcion
                ]);
            }
        }
    }

    public function storeParametricaTipoFactura($dataSincronizar)
    {
        $resParametricaTipoFactura =  $this->sincronizar->sincronizarParametricaTiposFactura($dataSincronizar);
        $cantidadRegistrosBD = ImpuestoTipoFactura::count();
        $cantidadTipoFactura = count($resParametricaTipoFactura->content->listaCodigos);
        $tiposFacturas = $resParametricaTipoFactura->content->listaCodigos;
        if ($cantidadRegistrosBD < $cantidadTipoFactura) {
            foreach ($tiposFacturas as $tipoFactura) {
                ImpuestoTipoFactura::create([
                    'codigo_clasificador' => $tipoFactura->codigoClasificador,
                    'descripcion' => $tipoFactura->descripcion
                ]);
            }
        }
    }

    public function storeListaMensajesServicio($dataSincronizar)
    {
        $resMensajeServicio =  $this->sincronizar->sincronizarListaMensajesServicios($dataSincronizar);
        $cantidadRegistrosBD = ImpuestoMensajeServicio::count();
        $cantidadMensajesServicios = count($resMensajeServicio->content->listaCodigos);
        $mensajesServicios = $resMensajeServicio->content->listaCodigos;
        if ($cantidadRegistrosBD < $cantidadMensajesServicios) {
            foreach ($mensajesServicios as $mensajeServicio) {
                ImpuestoMensajeServicio::create([
                    'codigo_clasificador' => $mensajeServicio->codigoClasificador,
                    'descripcion' => $mensajeServicio->descripcion
                ]);
            }
        }
    }

    public function storeParametricaEventoSignificativo($dataSincronizar)
    {
        $resEventoSignificativo =  $this->sincronizar->sincronizarParametricaEventosSignificativos($dataSincronizar);

        $cantidadRegistrosBD = ImpuestoEventoSignificativo::count();
        $cantidadEventosSignificativos = count($resEventoSignificativo->content->listaCodigos);
        $eventosSignificativos = $resEventoSignificativo->content->listaCodigos;
        if ($cantidadRegistrosBD < $cantidadEventosSignificativos) {
            foreach ($eventosSignificativos as $eventoSignificativo) {
                ImpuestoEventoSignificativo::create([
                    'codigo_clasificador' => $eventoSignificativo->codigoClasificador,
                    'descripcion' => $eventoSignificativo->descripcion
                ]);
            }
        }
    }

    public function storeParametricaTipoPuntoVenta($dataSincronizar)
    {
        $resParametricaPuntoVenta =  $this->sincronizar->sincronizarParametricaTipoPuntoVenta($dataSincronizar);
        $cantidadRegistrosBD = ImpuestoTipoPuntoVenta::count();
        $cantidadTiposPuntosVentas = count($resParametricaPuntoVenta->content->listaCodigos);
        $tiposPuntosVentas = $resParametricaPuntoVenta->content->listaCodigos;
        if ($cantidadRegistrosBD < $cantidadTiposPuntosVentas) {
            foreach ($tiposPuntosVentas as $puntoVenta) {
                ImpuestoTipoPuntoVenta::create([
                    'codigo_clasificador' => $puntoVenta->codigoClasificador,
                    'descripcion' => $puntoVenta->descripcion
                ]);
            }
        }
    }

    public function storeListaProductosServicios($dataSincronizar) //check
    {
        $resProductoServicio =  $this->sincronizar->sincronizarListaProductosServicios($dataSincronizar);
    }

    public function storeParametricaTipoMoneda($dataSincronizar)
    {
        $resParametricaTipoMoneda =  $this->sincronizar->sincronizarParametricaTipoMoneda($dataSincronizar);
        $cantidadTiposMonedas = count($resParametricaTipoMoneda->content->listaCodigos);
        $cantidadRegistrosBD = ImpuestoTipoMoneda::count();
        $tiposMonedas = $resParametricaTipoMoneda->content->listaCodigos;
        if ($cantidadRegistrosBD < $cantidadTiposMonedas) {
            foreach ($tiposMonedas as $tipoMoneda) {
                ImpuestoTipoMoneda::create([
                    'codigo_clasificador' => $tipoMoneda->codigoClasificador,
                    'descripcion' => $tipoMoneda->descripcion
                ]);
            }
        }
    }

    public function storeSincronizarActividades($dataSincronizar) //check
    {
        $resSincronizarActividades =  $this->sincronizar->sincronizarActividades($dataSincronizar);
    }

    public function storeParametricaTipoEmision($dataSincronizar)
    {
        $resParametricaTipoEmision =  $this->sincronizar->sincronizarParametricaTipoEmision($dataSincronizar);
        $cantidadRegistrosBD = ImpuestoTipoEmision::count();
        $cantidadTiposEmisiones = count($resParametricaTipoEmision->content->listaCodigos);
        $tiposEmisiones = $resParametricaTipoEmision->content->listaCodigos;
        if ($cantidadRegistrosBD < $cantidadTiposEmisiones) {
            foreach ($tiposEmisiones as $tipoEmision) {
                ImpuestoTipoEmision::create([
                    'codigo_clasificador' => $tipoEmision->codigoClasificador,
                    'descripcion' => $tipoEmision->descripcion
                ]);
            }
        }
    }

    public function storeParametricaTipoDocumentoIdentidad($dataSincronizar)
    {
        $resParametricaTipoDocumentoIdentidad =  $this->sincronizar->sincronizarParametricaTipoDocumentoIdentidad($dataSincronizar);
        $cantidadRegistrosBD = ImpuestoDocumentoIdentidad::count();
        $cantidadDocumentosIdentidad = count($resParametricaTipoDocumentoIdentidad->content->listaCodigos);
        $tiposDocumentosIdentidades = $resParametricaTipoDocumentoIdentidad->content->listaCodigos;
        if ($cantidadRegistrosBD < $cantidadDocumentosIdentidad) {
            foreach ($tiposDocumentosIdentidades as $documentoIdentidad) {
                ImpuestoDocumentoIdentidad::create([
                    'codigo_clasificador' => $documentoIdentidad->codigoClasificador,
                    'descripcion' => $documentoIdentidad->descripcion
                ]);
            }
        }

    }

    public function storeSincronizarListaLeyendasFactura($dataSincronizar) //check
    {
       /*  $resListaLeyendasFactura =  $this->sincronizar->sincronizarListaLeyendasFactura($dataSincronizar);
        $cantidadRegistrosBD = ImpuestoLeyendaFactura::count();
        $cantidadLeyendasFacturas = count($resListaLeyendasFactura->content->listaCodigos);
        $tiposLeyendasFacturas = $resListaLeyendasFactura->content->listaCodigos;
        if ($cantidadRegistrosBD < $cantidadLeyendasFacturas) {
            foreach ($tiposLeyendasFacturas as $leyendaFactura) {
                ImpuestoLeyendaFactura::create([
                    'codigo_clasificador' => $leyendaFactura->codigoClasificador,
                    'descripcion' => $leyendaFactura->descripcion
                ]);
            }
        } */
    }

    public function storeParametricaTipoMetodoPago($dataSincronizar)
    {
        $resParametricaTipoMetodoPago =  $this->sincronizar->sincronizarParametricaTipoMetodoPago($dataSincronizar);
        $cantidadRegistrosBD = ImpuestoMetodoPago::count();
        $cantidadMetodosPagos = count($resParametricaTipoMetodoPago->content->listaCodigos);
        $tiposMetodosPagos = $resParametricaTipoMetodoPago->content->listaCodigos;
        if ($cantidadRegistrosBD < $cantidadMetodosPagos) {
            foreach ($tiposMetodosPagos as $metodoPago) {
                ImpuestoMetodoPago::create([
                    'codigo_clasificador' => $metodoPago->codigoClasificador,
                    'descripcion' => $metodoPago->descripcion
                ]);
            }
        }
    }

    public function storeParametricaUnidadMedida($dataSincronizar)
    {
        $resParametricaUnidadMedida =  $this->sincronizar->sincronizarParametricaUnidadMedida($dataSincronizar);
        $cantidadRegistrosBD = ImpuestoUnidadMedida::count();
        $cantidadUnidadesMedidas = count($resParametricaUnidadMedida->content->listaCodigos);
        $tiposUnidadesMedidas = $resParametricaUnidadMedida->content->listaCodigos;
        if ($cantidadRegistrosBD < $cantidadUnidadesMedidas) {
            foreach ($tiposUnidadesMedidas as $unidadMedida) {
                ImpuestoUnidadMedida::create([
                    'codigo_clasificador' => $unidadMedida->codigoClasificador,
                    'descripcion' => $unidadMedida->descripcion
                ]);
            }
        }
    }

    public function storeParametricaPaisOrigen($dataSincronizar)
    {
        $sincronizarParametricaPaisOrigen =  $this->sincronizar->sincronizarParametricaPaisOrigen($dataSincronizar);
        $cantidadRegistrosBD = ImpuestoListadoPais::count();
        $cantidadPaisesOrigen = count($sincronizarParametricaPaisOrigen->content->listaCodigos);
        $tiposPaisesOrigen = $sincronizarParametricaPaisOrigen->content->listaCodigos;
        if ($cantidadRegistrosBD < $cantidadPaisesOrigen) {
            foreach ($tiposPaisesOrigen as $paisOrigen) {
                ImpuestoListadoPais::create([
                    'codigo_clasificador' => $paisOrigen->codigoClasificador,
                    'descripcion' => $paisOrigen->descripcion
                ]);
            }
        }
    }


    public function storeFechaHoraImpuesto($dataSincronizar) //check
    {
        $resFechaHora =  $this->sincronizar->sincronizarFechaHora($dataSincronizar);
    }


    public function storeParametricaTipoHabitacion($dataSincronizar)
    {
        $resParametricaTipoHabitacion =  $this->sincronizar->sincronizarParametricaTipoHabitacion($dataSincronizar);
        $cantidadRegistrosBD = ImpuestoTipoHabitacion::count();
        $cantidadHabitaciones = count($resParametricaTipoHabitacion->content->listaCodigos);
        $tiposHabitaciones = $resParametricaTipoHabitacion->content->listaCodigos;
        if ($cantidadRegistrosBD < $cantidadHabitaciones) {
            foreach ($tiposHabitaciones as $habitacion) {
                ImpuestoTipoHabitacion::create([
                    'codigo_clasificador' => $habitacion->codigoClasificador,
                    'descripcion' => $habitacion->descripcion
                ]);
            }
        }
    }

    public function sincronizarCatalogosImpuestos($dataSincronizar)
    {
        $this->storeParametricaMotivoAnulacion($dataSincronizar);
        /* $this->storeActividadesDocumentoSector($dataSincronizar);  no*/
        $this->storeParametricaTipoDocumentoSector($dataSincronizar);
        $this->storeParametricaTipoFactura($dataSincronizar);
        $this->storeListaMensajesServicio($dataSincronizar);
        $this->storeParametricaEventoSignificativo($dataSincronizar);
        $this->storeParametricaTipoPuntoVenta($dataSincronizar);
        /* $this->storeListaProductosServicios($dataSincronizar);  no*/
        $this->storeParametricaTipoMoneda($dataSincronizar);
        /* $this->storeSincronizarActividades($dataSincronizar); no */
        $this->storeParametricaTipoEmision($dataSincronizar);
        $this->storeParametricaTipoDocumentoIdentidad($dataSincronizar);
        /* $this->storeSincronizarListaLeyendasFactura($dataSincronizar); no*/
        $this->storeParametricaTipoMetodoPago($dataSincronizar);
        $this->storeParametricaUnidadMedida($dataSincronizar);
        $this->storeParametricaPaisOrigen($dataSincronizar);
        /* $this->storeFechaHoraImpuesto($dataSincronizar); no*/
        $this->storeParametricaTipoHabitacion($dataSincronizar);

        return responseJson('Catalogos Sincronizados!', $dataSincronizar, 200);
    }
}
