<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use Illuminate\Http\Request;

class DocenteController extends Controller
{
    public function index(){

        return view('docentes.index');
    }

    public function create(){

        return view('docentes.create');
    }

    public function store(Request $request){

        try {
            $docente = new Docente();
            $docente->nombre_completo   = $request->nombre_completo;
            $docente->matricula         = $request->matricula;
            $docente->fecha_incorporacion = $request->fecha_incorporacion;
            $docente->telefono          = $request->telefono;
            $docente->direccion         = $request->direccion;
            $docente->estado            = $request->estado;
            $docente->save();

            if ( $docente->save()) {
                return response()->json([
                    'success'=> true,
                    'response' => 'Registrado con Exito!'
                ]);
            }else{
                return response()->json([
                    'success'=> true,
                    'response' => 'Something went Wrong!'
                ]);
            }
        } catch (\Throwable $th) {
            return back()->withErrors($th);
        }


    }
}
