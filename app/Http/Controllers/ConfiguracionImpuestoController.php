<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConfImp\StoreConfImpRequest;
use App\Models\ConfiguracionImpuesto;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfiguracionImpuestoController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            ['link' => 'home', 'name' => 'Home'],
            ['link' => 'javascript:void(0)', 'name' => 'Configuraciones de Impuestos'],
        ];
        $pageConfigs = [
            'pageHeader' => true,
            'isFabButton' => true,
        ];
        // $taxesConfigurations = ConfiguracionImpuesto::where('empresa_id', Auth::user()->empresas[0]->id)->get();
        $taxesConfigurations = ConfiguracionImpuesto::all();
        $enterprises = Empresa::all();

        return view('configuraciones_impuestos.index', [
            'taxesConfigurations' => $taxesConfigurations,
            'enterprises' => $enterprises,
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    public function create()
    {
        $enterprises = Empresa::all();

        return view('configuraciones_impuestos.create', compact('enterprises'));
    }

    public function edit($id)
    {
        $conf = ConfiguracionImpuesto::find($id);
        $enterprises = Empresa::all();

        return view('configuraciones_impuestos.create', compact('conf', 'enterprises'));
    }

    public function store(StoreConfImpRequest $request)
    {
        try {
            if (! empty($request->id_conf)) {
                return $this->update($request, $request->id_config);
            }
            $taxesConfiguration = new ConfiguracionImpuesto();
            $taxesConfiguration->nombre_sistema = $request->nombre_sistema;
            $taxesConfiguration->ambiente = $request->ambiente;
            $taxesConfiguration->modalidad = $request->modalidad;
            $taxesConfiguration->codigo_sistema = $request->codigo_sistema;
            $taxesConfiguration->token_sistema = $request->token_sistema;
            $taxesConfiguration->empresa_id = $request->empresa_id;
            $taxesConfiguration->estado = $request->estado;
            $taxesConfiguration->save();
            if ($taxesConfiguration->save()) {
                return responseJson('Registrado Exitosamente', $taxesConfiguration, 200);
            } else {
                return responseJson('Something Went Wrong', $taxesConfiguration, 404);
            }
        } catch (\Exception $e) {
            return responseJson('Server Error', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $taxesConfiguration = ConfiguracionImpuesto::find($id);
            $taxesConfiguration->nombre_sistema = $request->nombre_sistema;
            $taxesConfiguration->ambiente = $request->ambiente;
            $taxesConfiguration->modalidad = $request->modalidad;
            $taxesConfiguration->codigo_sistema = $request->codigo_sistema;
            $taxesConfiguration->token_sistema = $request->token_sistema;
            $taxesConfiguration->empresa_id = $request->empresa_id;
            $taxesConfiguration->estado = $request->estado;
            $taxesConfiguration->save();
            if ($taxesConfiguration->save()) {
                return responseJson('Actualizado Exitosamente', $taxesConfiguration, 200);
            } else {
                return responseJson('Something Went Wrong', $taxesConfiguration, 404);
            }
        } catch (\Exception $e) {
            return responseJson('Server Error', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ], 500);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $taxesConfiguration = ConfiguracionImpuesto::find($request->configuracion_impuesto_id);
            $taxesConfiguration->delete();

            if ($taxesConfiguration->trashed()) {
                return responseJson('Eliminado Exitosamente', $taxesConfiguration, 200);
            }
        } catch (\Exception $e) {
            return responseJson('Server Error', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ], 500);
        }
    }
}
