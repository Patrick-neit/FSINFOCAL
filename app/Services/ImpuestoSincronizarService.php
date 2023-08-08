<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ImpuestoSincronizarService
{
    public $config;

    public function __construct()
    {
        $this->config = new ImpuestoConfigService();
    }

    function sincronizarParametricaMotivoAnulacion($dataSincronizar)
    {
        $response = Http::withHeaders([
            'apikey' => $this->config->configService->token_sistema
        ])
            ->post(
                'https://catalogos.rda-consultores.com/api/sincronizar',
                [
                    'codigoAmbiente' => $this->config->configService->codigoAmbiente,
                    'codigoSistema' => $this->config->configService->codigoSistema,
                    'nit' => $this->config->configService->nit,
                    'cuis' => $dataSincronizar->cuis,
                    'codigoModalidad' => $this->config->configService->codigoModalidad,
                    'codigoSucursal' =>  $dataSincronizar->codigoSucursal,
                    'codigoPuntoVenta' => $dataSincronizar->codigoPuntoVenta,
                    'accion' => "sincronizarParametricaMotivoAnulacion"
                ]
            );

        return $response->object();
    }

    function sincronizarListaActividadesDocumentoSector($dataSincronizar)
    {
        $response = Http::withHeaders([
            'apikey' => $this->config->configService->token_sistema
        ])
            ->post(
                'https://catalogos.rda-consultores.com/api/sincronizar',
                [
                    'codigoAmbiente' => $this->config->configService->codigoAmbiente,
                    'codigoSistema' => $this->config->configService->codigoSistema,
                    'nit' => $this->config->configService->nit,
                    'cuis' => $dataSincronizar->cuis,
                    'codigoModalidad' => $this->config->configService->codigoModalidad,
                    'codigoSucursal' =>  $dataSincronizar->codigoSucursal,
                    'codigoPuntoVenta' => $dataSincronizar->codigoPuntoVenta,
                    'accion' => "sincronizarListaActividadesDocumentoSector"
                ]
            );

        return $response->object();
    }

    function sincronizarParametricaTipoDocumentoSector($dataSincronizar)
    {
        $response = Http::withHeaders([
            'apikey' => $this->config->configService->token_sistema
        ])
            ->post(
                'https://catalogos.rda-consultores.com/api/sincronizar',
                [
                    'codigoAmbiente' => $this->config->configService->codigoAmbiente,
                    'codigoSistema' => $this->config->configService->codigoSistema,
                    'nit' => $this->config->configService->nit,
                    'cuis' => $dataSincronizar->cuis,
                    'codigoModalidad' => $this->config->configService->codigoModalidad,
                    'codigoSucursal' =>  $dataSincronizar->codigoSucursal,
                    'codigoPuntoVenta' => $dataSincronizar->codigoPuntoVenta,
                    'accion' => "sincronizarParametricaTipoDocumentoSector"
                ]
            );

        return $response->object();
    }

    function sincronizarParametricaTiposFactura($dataSincronizar)
    {
        $response = Http::withHeaders([
            'apikey' => $this->config->configService->token_sistema
        ])
            ->post(
                'https://catalogos.rda-consultores.com/api/sincronizar',
                [
                    'codigoAmbiente' => $this->config->configService->codigoAmbiente,
                    'codigoSistema' => $this->config->configService->codigoSistema,
                    'nit' => $this->config->configService->nit,
                    'cuis' => $dataSincronizar->cuis,
                    'codigoModalidad' => $this->config->configService->codigoModalidad,
                    'codigoSucursal' =>  $dataSincronizar->codigoSucursal,
                    'codigoPuntoVenta' => $dataSincronizar->codigoPuntoVenta,
                    'accion' => "sincronizarParametricaTiposFactura"
                ]
            );

        return $response->object();
    }

    function sincronizarListaMensajesServicios($dataSincronizar)
    {
        $response = Http::withHeaders([
            'apikey' => $this->config->configService->token_sistema
        ])
            ->post(
                'https://catalogos.rda-consultores.com/api/sincronizar',
                [
                    'codigoAmbiente' => $this->config->configService->codigoAmbiente,
                    'codigoSistema' => $this->config->configService->codigoSistema,
                    'nit' => $this->config->configService->nit,
                    'cuis' => $dataSincronizar->cuis,
                    'codigoModalidad' => $this->config->configService->codigoModalidad,
                    'codigoSucursal' =>  $dataSincronizar->codigoSucursal,
                    'codigoPuntoVenta' => $dataSincronizar->codigoPuntoVenta,
                    'accion' => "sincronizarListaMensajesServicios"
                ]
            );

        return $response->object();
    }

    function sincronizarParametricaEventosSignificativos($dataSincronizar)
    {
        $response = Http::withHeaders([
            'apikey' => $this->config->configService->token_sistema
        ])
            ->post(
                'https://catalogos.rda-consultores.com/api/sincronizar',
                [
                    'codigoAmbiente' => $this->config->configService->codigoAmbiente,
                    'codigoSistema' => $this->config->configService->codigoSistema,
                    'nit' => $this->config->configService->nit,
                    'cuis' => $dataSincronizar->cuis,
                    'codigoModalidad' => $this->config->configService->codigoModalidad,
                    'codigoSucursal' =>  $dataSincronizar->codigoSucursal,
                    'codigoPuntoVenta' => $dataSincronizar->codigoPuntoVenta,
                    'accion' => "sincronizarParametricaEventosSignificativos"
                ]
            );

        return $response->object();
    }

    function sincronizarParametricaTipoPuntoVenta($dataSincronizar)
    {
        $response = Http::withHeaders([
            'apikey' => $this->config->configService->token_sistema
        ])
            ->post(
                'https://catalogos.rda-consultores.com/api/sincronizar',
                [
                    'codigoAmbiente' => $this->config->configService->codigoAmbiente,
                    'codigoSistema' => $this->config->configService->codigoSistema,
                    'nit' => $this->config->configService->nit,
                    'cuis' => $dataSincronizar->cuis,
                    'codigoModalidad' => $this->config->configService->codigoModalidad,
                    'codigoSucursal' =>  $dataSincronizar->codigoSucursal,
                    'codigoPuntoVenta' => $dataSincronizar->codigoPuntoVenta,
                    'accion' => "sincronizarParametricaTipoPuntoVenta"
                ]
            );

        return $response->object();
    }

    function sincronizarListaProductosServicios($dataSincronizar)
    {
        $response = Http::withHeaders([
            'apikey' => $this->config->configService->token_sistema
        ])
            ->post(
                'https://catalogos.rda-consultores.com/api/sincronizar',
                [
                    'codigoAmbiente' => $this->config->configService->codigoAmbiente,
                    'codigoSistema' => $this->config->configService->codigoSistema,
                    'nit' => $this->config->configService->nit,
                    'cuis' => $dataSincronizar->cuis,
                    'codigoModalidad' => $this->config->configService->codigoModalidad,
                    'codigoSucursal' =>  $dataSincronizar->codigoSucursal,
                    'codigoPuntoVenta' => $dataSincronizar->codigoPuntoVenta,
                    'accion' => "sincronizarListaProductosServicios"
                ]
            );

        return $response->object();
    }

    function sincronizarParametricaTipoMoneda($dataSincronizar)
    {
        $response = Http::withHeaders([
            'apikey' => $this->config->configService->token_sistema
        ])
            ->post(
                'https://catalogos.rda-consultores.com/api/sincronizar',
                [
                    'codigoAmbiente' => $this->config->configService->codigoAmbiente,
                    'codigoSistema' => $this->config->configService->codigoSistema,
                    'nit' => $this->config->configService->nit,
                    'cuis' => $dataSincronizar->cuis,
                    'codigoModalidad' => $this->config->configService->codigoModalidad,
                    'codigoSucursal' =>  $dataSincronizar->codigoSucursal,
                    'codigoPuntoVenta' => $dataSincronizar->codigoPuntoVenta,
                    'accion' => "sincronizarParametricaTipoMoneda"
                ]
            );

        return $response->object();
    }

    function sincronizarActividades($dataSincronizar)
    {
        $response = Http::withHeaders([
            'apikey' => $this->config->configService->token_sistema
        ])
            ->post(
                'https://catalogos.rda-consultores.com/api/sincronizar',
                [
                    'codigoAmbiente' => $this->config->configService->codigoAmbiente,
                    'codigoSistema' => $this->config->configService->codigoSistema,
                    'nit' => $this->config->configService->nit,
                    'cuis' => $dataSincronizar->cuis,
                    'codigoModalidad' => $this->config->configService->codigoModalidad,
                    'codigoSucursal' =>  $dataSincronizar->codigoSucursal,
                    'codigoPuntoVenta' => $dataSincronizar->codigoPuntoVenta,
                    'accion' => "sincronizarActividades"
                ]
            );

        return $response->object();
    }

    function sincronizarParametricaTipoEmision($dataSincronizar)
    {
        $response = Http::withHeaders([
            'apikey' => $this->config->configService->token_sistema
        ])
            ->post(
                'https://catalogos.rda-consultores.com/api/sincronizar',
                [
                    'codigoAmbiente' => $this->config->configService->codigoAmbiente,
                    'codigoSistema' => $this->config->configService->codigoSistema,
                    'nit' => $this->config->configService->nit,
                    'cuis' => $dataSincronizar->cuis,
                    'codigoModalidad' => $this->config->configService->codigoModalidad,
                    'codigoSucursal' =>  $dataSincronizar->codigoSucursal,
                    'codigoPuntoVenta' => $dataSincronizar->codigoPuntoVenta,
                    'accion' => "sincronizarParametricaTipoEmision"
                ]
            );

        return $response->object();
    }

    function sincronizarParametricaTipoDocumentoIdentidad($dataSincronizar)
    {
        $response = Http::withHeaders([
            'apikey' => $this->config->configService->token_sistema
        ])
            ->post(
                'https://catalogos.rda-consultores.com/api/sincronizar',
                [
                    'codigoAmbiente' => $this->config->configService->codigoAmbiente,
                    'codigoSistema' => $this->config->configService->codigoSistema,
                    'nit' => $this->config->configService->nit,
                    'cuis' => $dataSincronizar->cuis,
                    'codigoModalidad' => $this->config->configService->codigoModalidad,
                    'codigoSucursal' =>  $dataSincronizar->codigoSucursal,
                    'codigoPuntoVenta' => $dataSincronizar->codigoPuntoVenta,
                    'accion' => "sincronizarParametricaTipoDocumentoIdentidad"
                ]
            );

        return $response->object();
    }

    function sincronizarListaLeyendasFactura($dataSincronizar)
    {
        $response = Http::withHeaders([
            'apikey' => $this->config->configService->token_sistema
        ])
            ->post(
                'https://catalogos.rda-consultores.com/api/sincronizar',
                [
                    'codigoAmbiente' => $this->config->configService->codigoAmbiente,
                    'codigoSistema' => $this->config->configService->codigoSistema,
                    'nit' => $this->config->configService->nit,
                    'cuis' => $dataSincronizar->cuis,
                    'codigoModalidad' => $this->config->configService->codigoModalidad,
                    'codigoSucursal' =>  $dataSincronizar->codigoSucursal,
                    'codigoPuntoVenta' => $dataSincronizar->codigoPuntoVenta,
                    'accion' => "sincronizarListaLeyendasFactura"
                ]
            );

        return $response->object();
    }

    function sincronizarParametricaTipoMetodoPago($dataSincronizar)
    {
        $response = Http::withHeaders([
            'apikey' => $this->config->configService->token_sistema
        ])
            ->post(
                'https://catalogos.rda-consultores.com/api/sincronizar',
                [
                    'codigoAmbiente' => $this->config->configService->codigoAmbiente,
                    'codigoSistema' => $this->config->configService->codigoSistema,
                    'nit' => $this->config->configService->nit,
                    'cuis' => $dataSincronizar->cuis,
                    'codigoModalidad' => $this->config->configService->codigoModalidad,
                    'codigoSucursal' =>  $dataSincronizar->codigoSucursal,
                    'codigoPuntoVenta' => $dataSincronizar->codigoPuntoVenta,
                    'accion' => "sincronizarParametricaTipoMetodoPago"
                ]
            );

        return $response->object();
    }


    function sincronizarParametricaUnidadMedida($dataSincronizar)
    {
        $response = Http::withHeaders([
            'apikey' => $this->config->configService->token_sistema
        ])
            ->post(
                'https://catalogos.rda-consultores.com/api/sincronizar',
                [
                    'codigoAmbiente' => $this->config->configService->codigoAmbiente,
                    'codigoSistema' => $this->config->configService->codigoSistema,
                    'nit' => $this->config->configService->nit,
                    'cuis' => $dataSincronizar->cuis,
                    'codigoModalidad' => $this->config->configService->codigoModalidad,
                    'codigoSucursal' =>  $dataSincronizar->codigoSucursal,
                    'codigoPuntoVenta' => $dataSincronizar->codigoPuntoVenta,
                    'accion' => "sincronizarParametricaUnidadMedida"
                ]
            );

        return $response->object();
    }

    function sincronizarParametricaPaisOrigen($dataSincronizar)
    {
        $response = Http::withHeaders([
            'apikey' => $this->config->configService->token_sistema
        ])
            ->post(
                'https://catalogos.rda-consultores.com/api/sincronizar',
                [
                    'codigoAmbiente' => $this->config->configService->codigoAmbiente,
                    'codigoSistema' => $this->config->configService->codigoSistema,
                    'nit' => $this->config->configService->nit,
                    'cuis' => $dataSincronizar->cuis,
                    'codigoModalidad' => $this->config->configService->codigoModalidad,
                    'codigoSucursal' =>  $dataSincronizar->codigoSucursal,
                    'codigoPuntoVenta' => $dataSincronizar->codigoPuntoVenta,
                    'accion' => "sincronizarParametricaPaisOrigen"
                ]
            );

        return $response->object();
    }

    function sincronizarFechaHora($dataSincronizar)
    {
        $response = Http::withHeaders([
            'apikey' => $this->config->configService->token_sistema
        ])
            ->post(
                'https://catalogos.rda-consultores.com/api/sincronizar',
                [
                    'codigoAmbiente' => $this->config->configService->codigoAmbiente,
                    'codigoSistema' => $this->config->configService->codigoSistema,
                    'nit' => $this->config->configService->nit,
                    'cuis' => $dataSincronizar->cuis,
                    'codigoModalidad' => $this->config->configService->codigoModalidad,
                    'codigoSucursal' =>  $dataSincronizar->codigoSucursal,
                    'codigoPuntoVenta' => $dataSincronizar->codigoPuntoVenta,
                    'accion' => "sincronizarFechaHora"
                ]
            );

        return $response->object();
    }

    function sincronizarParametricaTipoHabitacion($dataSincronizar)
    {
        $response = Http::withHeaders([
            'apikey' => $this->config->configService->token_sistema
        ])
            ->post(
                'https://catalogos.rda-consultores.com/api/sincronizar',
                [
                    'codigoAmbiente' => $this->config->configService->codigoAmbiente,
                    'codigoSistema' => $this->config->configService->codigoSistema,
                    'nit' => $this->config->configService->nit,
                    'cuis' => $dataSincronizar->cuis,
                    'codigoModalidad' => $this->config->configService->codigoModalidad,
                    'codigoSucursal' =>  $dataSincronizar->codigoSucursal,
                    'codigoPuntoVenta' => $dataSincronizar->codigoPuntoVenta,
                    'accion' => "sincronizarParametricaTipoHabitacion"
                ]
            );

        return $response->object();
    }
}
