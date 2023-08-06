<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlumnoStoreRequest;
use App\Models\Alumno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlumnoController extends Controller
{
    public function index()
    {

        $alumnos = Alumno::where('empresa_id', Auth::user()->empresas[0]->id)->get();
        $alumnosTotales = Alumno::withTrashed()->count();
        $alumnosInactivos= Alumno::onlyTrashed()->count();
        return view('alumnos.index', compact('alumnos','alumnosTotales','alumnosInactivos'));
    }

    public function create()
    {
        return view('alumnos.create');
    }



    public function registrar_alumnos()
    {
        return view('alumnos.registrar');
    }



    public function store(AlumnoStoreRequest $request)
    {
        try {

            $alumno = new Alumno();
            $alumno->nombre = $request->first_name;
            $alumno->apellido = $request->last_name;
            $alumno->ci = $request->ci_alumno;
            $alumno->lugar_nacimiento = $request->lugar_nacimiento;
            $alumno->fecha_nacimiento = $request->fecha_nacimiento_alumno;
            $alumno->domicilio = $request->domicilio_alumno;
            $alumno->celular = $request->phone;
            $alumno->sexo = $request->sexo;
            $alumno->email = $request->email;
            $alumno->beca = $request->beca;
            $alumno->empresa_id = Auth::user()->empresas[0]->id;
            $alumno->save();

            if ($alumno->save()) {
                return response()->json([
                    'success' => true
                ]);
            }
        } catch (\Exception $e) {
            return responseJson('Server Error',[
                'message'=> $e->getMessage(),
                'code'=> $e->getCode(),
            ],500);
        }

    }

    public function edit($id)
    {
        $alumno = Alumno::find($id);
        return view('alumnos.edit', compact('alumno'));
    }

    public function update(Request $request, $id)
    {

        $alumno = Alumno::find($id);
        $alumno->nombre = $request->nombre;
        $alumno->apellido = $request->apellido;
        $alumno->ci = $request->ci;
        $alumno->lugar_nacimiento = $request->lugar_nacimiento;
        $alumno->fecha_nacimiento = $request->fecha_nacimiento;
        $alumno->domicilio = $request->domicilio;
        $alumno->celular = $request->celular;
        $alumno->sexo = $request->sexo;
        $alumno->email = $request->email;
        $alumno->beca = $request->beca;
        $alumno->save();

        return redirect()->route('alumnos.index');
    }

    public function destroy(Request $request)
    {
        $alumno = Alumno::find($request->alumno_id);
        $alumno->delete();

        if ($alumno->trashed()) {

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
        return redirect()->route('alumnos.index');
    }

    public function getDeleteStudents()
    {
        $students = Alumno::withTrashed()->get(); /* Students who has been eliminated and dont  */
        $students = Alumno::onlyTrashed()->get(); /* Students who has been eliminated */
        $students = Alumno::withTrashed()->restore(); /* Recover the registers who was been eliminated */
        $students = Alumno::withTrashed()->forceDelete(); /* Delete a register permanently */
        $student  = Alumno::where('id', 1)->withTrashed()->first();
        if ($student->trashed()) {
            return true; /* The register IS IN the trash basket */
        }
    }
}
