<?php

namespace App\Services;

use App\Models\Empresa;
use App\Models\Sucursal;
use Illuminate\Support\Facades\Http;

class ImpuestoCuisService
{
    public $config;

    public function __construct()
    {
        $this->config = new ImpuestoConfigService();
    }

    public function obtenerCuisImpuestos($dataService)
    {
        $sucursal = Sucursal::find($dataService->sucursal_id);
        $response = Http::withToken(authApiService()->access_token)
            ->post(
                config('sistema.url_api').'cuis',
                [
                    'codigoSucursal' => $sucursal->codigo_sucursal,
                    'codigoPuntoVenta' => !isset($dataService->tipo_punto_venta) ? 0 : $dataService->tipo_punto_venta,
                ]
            );

        return $response->object();
    }
}
