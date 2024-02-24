<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ImpuestoEmitirFacturaService
{
    public $config;

    public function __construct()
    {
        $this->config = new ImpuestoConfigService();
    }

    public function emitirFacturaImpuestos($dataFactura, $dataFacturaDetalle)
    {
        $response = Http::withHeaders([
            'apikey' => $this->config->configService->token_sistema,

        ])
            ->post(
                config('sistema.url_api').'api/recepcionFactura',
                [
                    'prop_general' => [
                        'codigoPuntoVenta' => 0,
                        'cuis' => '{{cuis}}',
                        'codigoControl' => '{{codigoControl}}',
                        'cufd' => '{{cufd}}',
                        'codigoSistema' => '{{codigo_sistema}}',
                        'nit' => '{{nit}}',
                        'tipoFacturaDocumento' => 1,
                        'codigoEmision' => 1,
                    ],
                    'correo' => [
                        'to' => 'naybor9817@gmail.com',
                        'from' => 'angel1@gmail.com',
                    ],
                    'facturas' => [
                        'cabecera' => $dataFactura,
                        'detalle' => $dataFacturaDetalle,
                    ],
                ]
            );

        return $response->object();
    }
}
