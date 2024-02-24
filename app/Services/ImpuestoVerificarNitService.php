<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ImpuestoVerificarNitService
{
    public $config;

    public function __construct()
    {
        $this->config = new ImpuestoConfigService();
    }

    public function verificarNit($clienteNit)
    {

        $response = Http::withHeaders([
            'apikey' => $this->config->configService->token_sistema,
        ])
            ->post(
                config('sistema.url_api').'api/verificarNit',
                [
                    'codigoAmbiente' => $this->config->configService->codigoAmbiente,
                    'codigoModalidad' => $this->config->configService->codigoModalidad,
                    'codigoSistema' => $this->config->configService->codigoSistema,
                    'codigoSucursal' => 0,
                    'nit' => $this->config->configService->nit,
                    'cuis' => 'FA11812C',
                    'nitParaVerificacion' => $clienteNit,
                ]
            );

        return $response->object();
    }
}
