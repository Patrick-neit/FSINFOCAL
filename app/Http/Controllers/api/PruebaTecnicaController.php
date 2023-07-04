<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Alumno;
use App\Models\AlumnoCurso;
use App\Models\Curso;
use App\Models\Docente;
use Illuminate\Http\Request;

class PruebaTecnicaController extends Controller
{
    public function storeStudent(Request $request)
    {
        try {

            $student = new Alumno();
            $student->nombre = $request->nombre;
            $student->apellido = $request->apellido;
            $student->save();

            return responseJson('Saved Object', $student, 200);
        } catch (\Exception $e) {
            return responseJson('Server Error', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
                'string' => $e->__toString()
            ], 500);
        }
    }

    public function storeTeacher(Request $request)
    {
        try {
            $teacher =  new Docente();
            $teacher->nombre = $request->nombre;
            $teacher->matricula = $request->matricula;
            $teacher->save();

            return  responseJson('Saved Object', $teacher, 200);
        } catch (\Exception $e) {
            return responseJson('Server Error', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
                'string' => $e->__toString()
            ], 500);
        }
    }


    public function storeCourse(Request $request)
    {
        try {
            $course = new Curso();
            $course->fecha_inicio = $request->fecha_inicio;
            $course->fecha_fin = $request->fecha_fin;
            $course->costo = $request->costo;
            $course->save();
            return responseJson('Saved Object', $course, 200);
        } catch (\Exception $e) {
            return responseJson('Server Error', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
                'string' => $e->__toString()
            ], 500);
        }
    }

    public function storeDetailCourse(Request $request)
    {
        try {

            $curso_id = $request->curso_id;
            foreach ($request->alumnos_cursos as $listado) {

                $detailCourse =  new AlumnoCurso();
                $detailCourse->alumno_id = $listado['alumno_id'];
                $detailCourse->docente_id = $listado['docente_id'];
                $detailCourse->curso_id = $curso_id;
                $detailCourse->save();
            }

            return responseJson('Saved Object', 'Saved Successfully', 200);
        } catch (\Exception $e) {
            return responseJson('Server Error', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
                'string' => $e->__toString()
            ], 500);
        }
    }
}
