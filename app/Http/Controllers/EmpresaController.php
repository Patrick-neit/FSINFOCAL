<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EmpresaController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            ['link' => 'home', 'name' => 'Home'],
            ['link' => 'javascript:void(0)', 'name' => 'Empresas'],
        ];
        $pageConfigs = [
            'pageHeader' => true,
            'isFabButton' => true,
        ];
        /* $empresas = Empresa::where('id', Auth::user()->empresas[0]->id)->get(); */
        $empresas = Empresa::all();

        return view('empresas.index', [
            'empresas' => $empresas,
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
        ]);
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
        if (! empty($request->id_empresa)) {
            return $this->update($request, $request->id_empresa);
        }
        if ($request->hasFile('logo_empresa')) {
            $path = Storage::disk('public')->put($request->nro_nit_empresa.'/logo', $request->file('logo_empresa'));
        }
        $enterprise = new Empresa();
        $enterprise->nombre_empresa = $request->nombre_empresa;
        $enterprise->nro_nit_empresa = $request->nro_nit_empresa;
        $enterprise->direccion = $request->direccion;
        $enterprise->telefono = $request->telefono;
        $enterprise->correo = $request->correo;
        $enterprise->logo = '/storage/'.$path;
        $enterprise->representante_legal = $request->representante_legal;
        if ($enterprise->save()) {
            return responseJson('Registrado Exitosamente', $enterprise, 200);
        } else {
            return responseJson('Something went Wrong', $enterprise, 400);
        }
        // try {
        //     if (!empty($request->id_empresa)) {
        //         return $this->update($request);
        //     }
        //     if ($request->hasFile('logo_empresa')) {
        //         $path = Storage::disk('public')->put($request->nro_nit_empresa . '/logo', $request->file('logo_empresa'));
        //     }
        //     $enterprise = new Empresa();
        //     $enterprise->nombre_empresa = $request->nombre_empresa;
        //     $enterprise->nro_nit_empresa = $request->nro_nit_empresa;
        //     $enterprise->direccion = $request->direccion;
        //     $enterprise->telefono = $request->telefono;
        //     $enterprise->correo = $request->correo;
        //     $enterprise->logo = '/storage/' . $path;
        //     $enterprise->representante_legal = $request->representante_legal;
        //     dd($enterprise->save());
        //     $enterprise->save();
        //     if ($enterprise->save()) {
        //         return responseJson('Registrado Exitosamente', $enterprise, 200);
        //     } else {
        //         return responseJson('Something went Wrong', $enterprise, 400);
        //     }
        // } catch (\Exception $e) {
        //     return responseJson('Server Error', [
        //         'message' => $e->getMessage(),
        //         'code' => $e->getCode(),
        //     ], 500);
        // }
    }

    public function update(Request $request, $id)
    {
        try {
            if ($request->hasFile('logo_empresa')) {

                $path = Storage::disk('public')->put($request->nro_nit_empresa.'/logo', $request->file('logo_empresa'));
            }
            $enterprise = Empresa::find($id);
            $enterprise->nombre_empresa = $request->nombre_empresa;
            $enterprise->nro_nit_empresa = $request->nro_nit_empresa;
            $enterprise->direccion = $request->direccion;
            $enterprise->telefono = $request->telefono;
            $enterprise->correo = $request->correo;
            $enterprise->logo = $request->hasFile('logo_empresa') ? '/storage/'.$path : $enterprise->logo;
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
