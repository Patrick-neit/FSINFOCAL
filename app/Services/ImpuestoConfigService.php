<?php

namespace App\Services;

use App\Models\ConfiguracionImpuesto;
use Illuminate\Support\Facades\Auth;

class ImpuestoConfigService
{
    public $configService;

    private $configImpuesto;

    public function __construct()
    {
        $this->configImpuesto = ConfiguracionImpuesto::where('empresa_id', 15 /*Auth::user()->empresas[0]->id */)
            ->first(); //Todo

        $this->configService = json_decode(json_encode([
            'codigoAmbiente' => $this->configImpuesto->ambiente,
            'codigoSistema' => $this->configImpuesto->codigo_sistema,
            'nit' => $this->configImpuesto->empresa->nro_nit_empresa,
            'codigoModalidad' => $this->configImpuesto->modalidad,
            'token_sistema' => $this->configImpuesto->token_sistema,
        ]));
    }
}
