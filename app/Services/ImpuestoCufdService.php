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


    public function obtenerCufdImpuestos($dataService, $resCodigoCuis)
    {
        $sucursal = Sucursal::find($dataService->sucursal_id);
        $response = Http::withToken(authApiService()->access_token)
            ->post(
                config('sistema.url_api').'cufd',
                [
                    'cuis' => $resCodigoCuis,
                    'codigoSucursal' => $sucursal->codigo_sucursal,
                    'codigoPuntoVenta' => !isset($dataService->tipo_punto_venta) ? 0 : $dataService->tipo_punto_venta,
                ]
            );

        return $response->object();
    }
}
