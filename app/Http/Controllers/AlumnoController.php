<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    public function index(){

        return view('alumnos.index');
    }

    public function create(){

        return view('alumnos.create');
    }

    public function store(Request $request){
        dd($request);
        $alumno = new Alumno();
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

    }

    public function edit($id){
        $alumno = Alumno::find($id);
        return view('alumnos.edit', compact('alumno'));
    }

    public function update(Request $request, $id){

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

    public function destroy($id){
        $alumno = Alumno::find($id);
        $alumno->destroy();

        return redirect()->route('alumnos.index');
    }
}
