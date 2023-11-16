<?php

namespace App\Http\Controllers;

use App\Models\ImpuestoCuis;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ImpuestoCuisController extends Controller
{
    public function store($resCuis, $dataService)
    {
        $registrarCuis = new ImpuestoCuis();
        $registrarCuis->fecha_generado = Carbon::now()->toDateTimeString();
        $registrarCuis->fecha_vencimiento = (new Carbon($resCuis->content->fechaVigencia->date))->toDateTimeString();
        $registrarCuis->codigo_cuis = $resCuis->content->codigo;
        $registrarCuis->estado = 'V';
        $registrarCuis->sucursal_id = $dataService->sucursal_id;
        $registrarCuis->empresa_id = Auth::user()->empresas[0]->id;
        $registrarCuis->save();

        return $registrarCuis->id;
    }
}
