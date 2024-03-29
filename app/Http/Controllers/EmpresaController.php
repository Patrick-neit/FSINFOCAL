<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmpresaController extends Controller
{
    public function index()
    {
        /* $empresas = Empresa::where('id', Auth::user()->empresas[0]->id)->get(); */
        $empresas = Empresa::all();
        return view('empresas.index', compact('empresas'));
    }

    public function create()
    {
        return view('empresas.create');
    }

    public function edit($id)
    {
        $empresa = Empresa::find($id);
        return view('empresas.create', compact('empresa'));
    }

    public function store(Request $request)
    {
        try {
            if (!empty($request->id_empresa)) {
                return $this->update($request);
            }
            $enterprise = new Empresa();
            $enterprise->nombre_empresa  = $request->nombre_empresa;
            $enterprise->nro_nit_empresa = $request->nro_nit_empresa;
            $enterprise->direccion       = $request->direccion;
            $enterprise->telefono        = $request->telefono;
            $enterprise->correo          = $request->correo;
            $enterprise->logo            = $request->logo;
            $enterprise->representante_legal = $request->representante_legal;
            $enterprise->save();

            if ($enterprise->save()) {
                return responseJson('Registrado Exitosamente', $enterprise, 200);
            } else {
                return responseJson('Something went Wrong', $enterprise, 400);
            }
        } catch (\Exception $e) {
            return responseJson('Server Error', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ], 500);
        }
    }

    public function update(Request $request)
    {
        try {
            $enterprise = Empresa::find($request->id_empresa);
            $enterprise->nombre_empresa  = $request->nombre_empresa;
            $enterprise->nro_nit_empresa = $request->nro_nit_empresa;
            $enterprise->direccion       = $request->direccion;
            $enterprise->telefono        = $request->telefono;
            $enterprise->correo          = $request->correo;
            $enterprise->logo            = $request->logo;
            $enterprise->representante_legal = $request->representante_legal;
            $enterprise->save();
            if ($enterprise->save()) {
                return responseJson('Actualizado Exitosamente', $enterprise, 200);
            } else {
                return responseJson('Something went Wrong', $enterprise, 400);
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
            $enterprise = Empresa::find($request->empresa_id);
            $enterprise->delete();

            if ($enterprise->trashed()) {
                return responseJson('Eliminado Exitosamente', $enterprise, 200);
            }
        } catch (\Exception $e) {
            return responseJson('Server Error', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ], 500);
        }
    }
}
