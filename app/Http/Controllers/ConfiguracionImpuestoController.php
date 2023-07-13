<?php

namespace App\Http\Controllers;

use App\Models\ConfiguracionImpuesto;
use App\Models\Empresa;
use Illuminate\Http\Request;

class ConfiguracionImpuestoController extends Controller
{
    public function index()
    {
        $taxesConfigurations = ConfiguracionImpuesto::all();
        return view('configuraciones_impuestos.index', compact('taxesConfigurations'));
    }
    public function create()
    {
        $enterprises = Empresa::all();
        return view('configuraciones_impuestos.create' , compact('enterprises'));
    }

    public function store(Request $request)
    {
        try {

            $taxesConfiguration = new ConfiguracionImpuesto();
            $taxesConfiguration->nombre_sistema = $request->nombre_sistema;
            $taxesConfiguration->codigo_sistema = $request->codigo_sistema;
            $taxesConfiguration->token_sistema = $request->token_sistema;
            $taxesConfiguration->empresa_id = $request->empresa_id;
            $taxesConfiguration->save();
            if ($taxesConfiguration->save()) {
                return responseJson('Registrado Exitosamente', $taxesConfiguration,200);
            }else{
                return responseJson('Something Went Wrong', $taxesConfiguration,404);
            }
        } catch (\Exception $e) {
            return responseJson('Server Error',[
                'message'=> $e->getMessage(),
                'code'=> $e->getCode(),
            ],500);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $taxesConfiguration = ConfiguracionImpuesto::find($request->configuracion_impuesto_id);
            $taxesConfiguration->delete();

            if ($taxesConfiguration->trashed()) {
                return responseJson('Eliminado Exitosamente', $taxesConfiguration,200);
            }
        } catch (\Exception $e) {
            return responseJson('Server Error',[
                'message'=> $e->getMessage(),
                'code'=> $e->getCode(),
            ],500);
        }
    }
}
