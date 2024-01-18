<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use App\Models\Sucursal;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class AlmacenController extends Controller
{
    public function index(){
        $almacenes = Almacen::all();
        return view('almacenes.index', compact('almacenes'));
    }
    public function create(){
        $empresaUserLog = Auth::user()->empresas()->first();
        // $encargados = User::whereHas('empresas', function ($query) use ($empresaUserLog){
        //     $query->where('empresa_id', $empresaUserLog->id);
        // })->get();
        $encargados = User::all();
        $sucursales = Sucursal::where('empresa_id', $empresaUserLog->id)->get();
        return view('almacenes.create', compact('sucursales','encargados'));
    }

    public function store(Request $request){
        try {
            $almacen = new Almacen();
            $almacen->nombre = $request->nombre_almacen;
            $almacen->capacidad_almacen = $request->capacidad_almacen;
            $almacen->encargado_id = $request->encargado_id;
            $almacen->sucursal_id = $request->sucursal_id;
            $almacen->save();
            if ($almacen->save()) {
                return responseJson('Almacen Guardado Exitosamente', $almacen,200);
            }
            return responseJson('Algo salio Mal', $almacen,400);

        } catch (\Exception $e) {
            return responseJson('Server Error', [
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $almacen = Almacen::find($request->almacen_id);
            $almacen->delete();
            if ($almacen->trashed()) {
                return responseJson('Eliminado Exitosamente', $almacen, 200);
            }
        } catch (\Exception $e) {
            return responseJson('Server Error', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ], 500);
        }
    }
}
