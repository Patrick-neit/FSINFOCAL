<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocenteStoreRequest;
use App\Models\Docente;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DocenteController extends Controller
{
    public function index()
    {
        $docentes = Docente::all();
        return view('docentes.index', compact('docentes'));
    }

    public function create(){

        return view('docentes.create');
    }

    public function store(DocenteStoreRequest $request)
    {
        try {

            $fechaIncorporacion = (new Carbon($request->fecha_incorporacion_docente))->toDateString();
            $docente = new Docente();
            $docente->nombre_completo   = $request->first_name;
            $docente->matricula         = $request->matricula_docente;
            $docente->fecha_incorporacion = $fechaIncorporacion;
            $docente->telefono          = $request->phone_docente;
            $docente->direccion         = $request->direccion;
            $docente->estado            = $request->estado;
            $docente->save();

            if ($docente->save()) {
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
        } catch (\Exception $e) {
            return responseJson('Server Error',[
                'message'=> $e->getMessage(),
                'codde'=> $e->getCode(),
            ],500);
        }
    }

    public function destroy(Request $request)
    {
        $docente = Docente::find($request->docente_id);
        $docente->delete();

        if ($docente->trashed()) {

            return response()->json([
                'success' => true,
                'response' => 'Ha Sido Eliminado con Exito'
            ]);

        } else {

            return response()->json([
                'success' => true,
                'response' => 'Something Went Wrong!'
            ]);
        }
        return redirect()->route('docentes.index');
    }
}
