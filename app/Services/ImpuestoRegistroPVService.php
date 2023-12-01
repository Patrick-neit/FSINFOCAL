<?php

namespace App\Services;

use App\Models\Sucursal;
use Illuminate\Support\Facades\Http;

class ImpuestoRegistroPVService
{
    public $config;

    public function __construct()
    {
        $this->config = new ImpuestoConfigService();
    }

    public function registrarPVImpuesto($dataService, $resCodigoCuis)
    {
        $sucursal = Sucursal::find($dataService->sucursal_id);
        $response = Http::withHeaders([
            'apikey' => $this->config->configService->token_sistema,
        ])
            ->post(
                config('sistema.url_api').'api/registroPuntoVenta',
                [
                    'codigoAmbiente' => $this->config->configService->codigoAmbiente,
                    'codigoModalidad' => $this->config->configService->codigoModalidad,
                    'codigoSistema' => $this->config->configService->codigoSistema,
                    'codigoSucursal' => $sucursal->codigo_sucursal,
                    'codigoTipoPuntoVenta' => $dataService->tipo_punto_venta,
                    'cuis' => $resCodigoCuis,
                    'descripcion' => $dataService->descripcion_punto_venta,
                    'nombrePuntoVenta' => $dataService->nombre_punto_venta,
                    'nit' => $this->config->configService->nit,
                ]
            );

        return $response->object();
    }
}
