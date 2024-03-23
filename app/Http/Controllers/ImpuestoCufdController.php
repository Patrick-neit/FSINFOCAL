<?php

namespace App\Http\Controllers;

use App\Models\ImpuestoCufd;
use App\Models\ImpuestoCuis;
use App\Models\Sucursal;
use App\Services\ImpuestoCufdService;
use App\Services\ImpuestoCuisService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ImpuestoCufdController extends Controller
{
    public function generateCufd(ImpuestoCufdService $impuestoCufdService){
        $sucursal = Sucursal::find(1);
        $cuis = ImpuestoCuis::where('sucursal_id', $sucursal->id)->first();
        $resCufd = $impuestoCufdService->obtenerCufdImpuestos();
    }
    public function store($resCufd, $dataService)
    {
        $registrarCufd = new ImpuestoCufd();
        $registrarCufd->fecha_generado = Carbon::now()->toDateTimeString();
        $registrarCufd->fecha_vencimiento = (new Carbon($resCufd->content->fechaVigencia->date))->toDateTimeString();
        $registrarCufd->codigo_cufd = $resCufd->content->codigo;
        $registrarCufd->codigo_control = $resCufd->content->codigoControl;
        $registrarCufd->direccion = $resCufd->content->direccion;
        $registrarCufd->estado = 'V';
        $registrarCufd->sucursal_id = $dataService->sucursal_id;
        $registrarCufd->empresa_id = Auth::user()->empresas[0]->id;
        $registrarCufd->save();

        return $registrarCufd->id;
    }

    public function getCufdExperimentalAuth(ImpuestoCuisService $authApiService)
    {
        $authApiService->obtenerCuisImpuestos('asdasd');
    }
}
