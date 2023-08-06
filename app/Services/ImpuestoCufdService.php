<?php

namespace App\Services;

use App\Models\Sucursal;
use Illuminate\Support\Facades\Http;

class ImpuestoCufdService
{
    public $config;

    public function __construct()
    {
        $this->config = new ImpuestoConfigService();
    }

    function obtenerCufdImpuestos($dataService,$resCodigoCuis)
    {
        $sucursal = Sucursal::find($dataService->sucursal_id);
        $response = Http::withHeaders([
            'apikey' => $this->config->configService->token_sistema
        ])
            ->post(
                'https://www.codigos.rda-consultores.com/api/codes/cufd',
                [
                    'codigoAmbiente' => $this->config->configService->codigoAmbiente,
                    'codigoSistema' => $this->config->configService->codigoSistema,
                    'nit' => $this->config->configService->nit,
                    'codigoModalidad' => $this->config->configService->codigoModalidad,
                    'cuis' => $resCodigoCuis,
                    'codigoSucursal' =>  $sucursal->codigo_sucursal,
                    'codigoPuntoVenta' => !isset($dataService->tipo_punto_venta) ? 0 : $dataService->tipo_punto_venta
                ]
            );

        return $response->object();
    }
}
