<?php

namespace App\Http\Controllers;

use App\Models\DetalleDosificacionEmpresa;
use App\Models\DosificacionEmpresa;
use App\Models\Empresa;
use App\Models\ImpuestoDocumentoSector;
use App\Models\ImpuestoTipoDocumentoSector;
use App\Models\ImpuestoTipoFactura;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class DosificacionEmpresaController extends Controller
{
    public function index(){
        return view('dosificaciones_empresas.index');
    }

    public function create(){
        $empresa = Empresa::where('id', Auth::user()->empresas[0]->id)->first();
        $documentoSectores = ImpuestoDocumentoSector::all();
        return view('dosificaciones_empresas.create', compact('empresa','documentoSectores'));
    }

    public function store(Request $request){
        try {
            $fechaAsignacion = Carbon::now()->toDateString();
            $dosificacion_empresa = new DosificacionEmpresa();
            $dosificacion_empresa->fecha_asignacion = $fechaAsignacion;
            $dosificacion_empresa->empresa_id = $request->empresa_id;
            $dosificacion_empresa->estado = 1;
            $dosificacion_empresa->save();
            if ($dosificacion_empresa->save()) {
                /* $detalle_dosificacion = new DetalleDosificacionEmpresa(); */

            }

        } catch (\Exception $e) {
            return responseJson('Server Error', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ], 500);
        }
    }

    public function getDataDocumentoSector(Request $request){
        try {
            $dataDocumentoSector = [];
            $documentoSectorID = $request->documento_sector_id;
            $tipoDocumentoSector = ImpuestoTipoDocumentoSector::where('codigo_documento_sector', $documentoSectorID)->first();
            $tipoFacturaDocumentoSector = ImpuestoTipoFactura::where('codigo_clasificador', $documentoSectorID)->first();
            $documentoSector = ImpuestoDocumentoSector::where('codigo_clasificador',$documentoSectorID)->first();

            if ($tipoDocumentoSector == null || $tipoFacturaDocumentoSector == null || $documentoSector == null) {
                return responseJson('No se pudo Obtener Informacion Impuesto', null , 400);
            }
            $dataDocumentoSector = [
                'empresa_id' => $request->empresa_id,
                'empresa_nombre' =>$request->empresa_nombre,
                'codigo_clasificador_ds'=> $documentoSectorID,
                'codigo_actividad_ds' => $tipoDocumentoSector->codigo_actividad,
                'tipo_factura_ds' => $tipoFacturaDocumentoSector->descripcion,
                'tipo_factura_cc' => $tipoFacturaDocumentoSector->codigo_clasificador,
                'descripcion_ds' => $documentoSector->descripcion
            ];

            session()->get('dosificaciones_sucursales_detalle');
            session()->push('dosificaciones_sucursales_detalle', $dataDocumentoSector);


            return responseJson('Data DS Encountered', session()->get('dosificaciones_sucursales_detalle'), 200);


        } catch (\Exception $e) {
            return responseJson('Server Error', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ], 500);
        }
    }
}
