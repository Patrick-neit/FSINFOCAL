<?php

namespace App\Services;

use App\Models\ConfiguracionImpuesto;
use Illuminate\Support\Facades\Auth;

class ImpuestoConfigService{
    public $configService;

    public function __construct()
    {
        $this->configService = ConfiguracionImpuesto::where('empresa_id', Auth::user()->empresas[0]->id)->first();
    }
}
