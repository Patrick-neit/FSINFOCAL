<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SucursalController extends Controller
{
    public function index()
    {
        $branches = Sucursal::where('empresa_id', Auth::user()->empresas[0]->id)->get();
        return view('sucursales.index', compact('branches'));
    }

    public function create()
    {
        $empresas = Empresa::where('id', Auth::user()->empresas[0]->id)->get();
        return view('sucursales.create', compact('empresas'));
    }

    public function store(Request $request)
    {
        try {
            $branch = new Sucursal();
            $branch->nombre_sucursal = $request->nombre_sucursal;
            $branch->direccion = $request->direccion;
            $branch->codigo_sucursal = $request->codigo_sucursal;
            $branch->telefono = $request->telefono;
            $branch->empresa_id = $request->empresa_id;
            $branch->save();
            if ($branch->save()) {
                return responseJson('Registrado Exitosamente', $branch,200);

            }else{
                return responseJson('Something went Wrong', $branch,400);
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

            $branch = Sucursal::find($request->sucursal_id);
            $branch->delete();

            if ($branch->trashed()) {
                return responseJson('Eliminado Exitosamente', $branch,200);
            }
        } catch (\Exception $e) {
            return responseJson('Server Error',[
                'message'=> $e->getMessage(),
                'code'=> $e->getCode(),
            ],500);
        }
    }
}
