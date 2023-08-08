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
                    'cuis'=> $dataSincronizar->cuis,
                    'codigoModalidad' => $this->config->configService->codigoModalidad,
                    'codigoSucursal' =>  $dataSincronizar->codigoSucursal,
                    'codigoPuntoVenta' => $dataSincronizar->codigoPuntoVenta,
                    'accion' => "sincronizarFechaHora"
                ]
            );

        return $response->object();
    }
}
