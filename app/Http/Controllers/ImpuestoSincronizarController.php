<?php

namespace App\Http\Controllers;

use App\Services\ImpuestoSincronizarService;
use Illuminate\Http\Request;

class ImpuestoSincronizarController extends Controller
{
    private $sincronizar;

    public function __construct()
    {
        $this->sincronizar = new ImpuestoSincronizarService();
    }

     function storeFechaHoraImpuesto($dataSincronizar)
    {
        $resFechaHora =  $this->sincronizar->sincronizarFechaHora($dataSincronizar);

    }

    public function sincronizarCatalogosImpuestos($dataSincronizar)
    {
        $this->storeFechaHoraImpuesto($dataSincronizar);
    }
}
