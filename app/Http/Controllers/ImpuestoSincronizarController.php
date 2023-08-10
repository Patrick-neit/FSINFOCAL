<?php

namespace App\Http\Controllers;

use App\Services\ImpuestoSincronizarService;
use Illuminate\Http\Request;

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
    }

    public function storeActividadesDocumentoSector($dataSincronizar)
    {
        $resActividadDocSector =  $this->sincronizar->sincronizarListaActividadesDocumentoSector($dataSincronizar);
    }

    public function storeParametricaTipoDocumentoSector($dataSincronizar)
    {
        $resParametricaDocSector =  $this->sincronizar->sincronizarParametricaTipoDocumentoSector($dataSincronizar);
    }

    public function storeParametricaTipoFactura($dataSincronizar)
    {
        $resParametricaTipoFactura =  $this->sincronizar->sincronizarParametricaTiposFactura($dataSincronizar);
    }

    public function storeListaMensajesServicio($dataSincronizar)
    {
        $resMensajeServicio =  $this->sincronizar->sincronizarListaMensajesServicios($dataSincronizar);
    }

    public function storeParametricaEventoSignificativo($dataSincronizar)
    {
        $resEventoSignificativo =  $this->sincronizar->sincronizarParametricaEventosSignificativos($dataSincronizar);
    }

    public function storeParametricaTipoPuntoVenta($dataSincronizar)
    {
        $resParametricaPuntoVenta =  $this->sincronizar->sincronizarParametricaTipoPuntoVenta($dataSincronizar);
    }

    public function storeListaProductosServicios($dataSincronizar)
    {
        $resProductoServicio =  $this->sincronizar->sincronizarListaProductosServicios($dataSincronizar);
    }

    public function storeParametricaTipoMoneda($dataSincronizar)
    {
        $resParametricaTipoMoneda =  $this->sincronizar->sincronizarParametricaTipoMoneda($dataSincronizar);
    }

    public function storeSincronizarActividades($dataSincronizar)
    {
        $resSincronizarActividades =  $this->sincronizar->sincronizarActividades($dataSincronizar);
    }

    public function storeParametricaTipoEmision($dataSincronizar)
    {
        $resParametricaTipoEmision =  $this->sincronizar->sincronizarParametricaTipoEmision($dataSincronizar);
    }

    public function storeParametricaTipoDocumentoIdentidad($dataSincronizar)
    {
        $resParametricaTipoDocumentoIdentidad =  $this->sincronizar->sincronizarParametricaTipoDocumentoIdentidad($dataSincronizar);
    }

    public function sincronizarListaLeyendasFactura($dataSincronizar)
    {
        $resListaLeyendasFactura =  $this->sincronizar->sincronizarListaLeyendasFactura($dataSincronizar);
    }

    public function storeParametricaTipoMetodoPago($dataSincronizar)
    {
        $resParametricaTipoMetodoPago =  $this->sincronizar->sincronizarParametricaTipoMetodoPago($dataSincronizar);
    }

    public function storeParametricaUnidadMedida($dataSincronizar)
    {
        $resParametricaUnidadMedida =  $this->sincronizar->sincronizarParametricaUnidadMedida($dataSincronizar);
    }

    public function storeParametricaPaisOrigen($dataSincronizar)
    {
        $sincronizarParametricaPaisOrigen =  $this->sincronizar->sincronizarParametricaPaisOrigen($dataSincronizar);
    }


    public function storeFechaHoraImpuesto($dataSincronizar)
    {
        $resFechaHora =  $this->sincronizar->sincronizarFechaHora($dataSincronizar);
    }


    public function storeParametricaTipoHabitacion($dataSincronizar)
    {
        $resParametricaTipoHabitacion =  $this->sincronizar->sincronizarParametricaTipoHabitacion($dataSincronizar);
    }

    public function sincronizarCatalogosImpuestos($dataSincronizar)
    {
        /* $this->storeParametricaMotivoAnulacion($dataSincronizar);
        $this->storeActividadesDocumentoSector($dataSincronizar);
        $this->storeParametricaTipoDocumentoSector($dataSincronizar);
        $this->storeParametricaTipoFactura($dataSincronizar);
        $this->storeListaMensajesServicio($dataSincronizar);
        $this->storeParametricaEventoSignificativo($dataSincronizar);
        $this->storeParametricaTipoPuntoVenta($dataSincronizar);
        $this->storeListaProductosServicios($dataSincronizar);
        $this->storeParametricaTipoMoneda($dataSincronizar);
        $this->storeSincronizarActividades($dataSincronizar);
        $this->storeParametricaTipoEmision($dataSincronizar);
        $this->storeParametricaTipoDocumentoIdentidad($dataSincronizar);
        $this->sincronizarListaLeyendasFactura($dataSincronizar);
        $this->storeParametricaTipoMetodoPago($dataSincronizar);
        $this->storeParametricaUnidadMedida($dataSincronizar);
        $this->storeParametricaPaisOrigen($dataSincronizar); */
        $this->storeFechaHoraImpuesto($dataSincronizar);
        $this->storeParametricaTipoHabitacion($dataSincronizar);

        return responseJson('Catalogos Sincronizados!', $dataSincronizar ,200);
    }


}
