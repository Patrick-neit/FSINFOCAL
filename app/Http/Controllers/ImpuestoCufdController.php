<?php

namespace App\Http\Controllers;

use App\Models\ImpuestoCufd;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ImpuestoCufdController extends Controller
{
    public function store($resCufd, $dataService)
    {
        $registrarCufd = new ImpuestoCufd();
        $registrarCufd->fecha_generado = Carbon::now()->toDateTimeString();
        $registrarCufd->fecha_vencimiento = (new Carbon($resCufd->content->RespuestaCufd->fechaVigencia->date))->toDateTimeString();
        $registrarCufd->codigo_cufd = $resCufd->content->RespuestaCufd->codigo;
        $registrarCufd->codigo_control = $resCufd->content->RespuestaCufd->codigoControl;
        $registrarCufd->direccion = $resCufd->content->RespuestaCufd->direccion;
        $registrarCufd->estado = 'V';
        $registrarCufd->sucursal_id = $dataService->sucursal_id;
        $registrarCufd->empresa_id = Auth::user()->empresas[0]->id;
        $registrarCufd->save();

        return $registrarCufd->id;
    }
}
