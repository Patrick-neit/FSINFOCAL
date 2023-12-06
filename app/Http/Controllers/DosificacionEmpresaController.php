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
use DB;
use Illuminate\Http\Request;

class DosificacionEmpresaController extends Controller
{
    public function index()
    {
        $dosificacionesEmpresas = DosificacionEmpresa::where('empresa_id', Auth::user()->empresas[0]->id)->get();

        return view('dosificaciones_empresas.index', compact('dosificacionesEmpresas'));
    }

    public function create()
    {
        $empresa = Empresa::where('id', Auth::user()->empresas[0]->id)->first();
        $documentoSectores = ImpuestoDocumentoSector::all();

        return view('dosificaciones_empresas.create', compact('empresa', 'documentoSectores'));
    }

    public function store(Request $request)
    {
        try {
            $fechaAsignacion = Carbon::now()->toDateString();
            DB::beginTransaction();
            $dosificacion_empresa = new DosificacionEmpresa();
            $dosificacion_empresa->fecha_asignacion = $fechaAsignacion;
            $dosificacion_empresa->cafc = $request->empresa_cafc;
            $dosificacion_empresa->inicio_nro_factura = $request->nro_inicio_factura;
            $dosificacion_empresa->fin_nro_factura = $request->nro_fin_factura;
            $dosificacion_empresa->empresa_id = $request->empresa_id;
            $dosificacion_empresa->estado = 1;
            $dosificacion_empresa->save();
            if ($dosificacion_empresa->save()) {
                foreach (session('dosificaciones_sucursales_detalle') as $key => $value) {
                    $detalle_dosificacion = new DetalleDosificacionEmpresa();
                    $detalle_dosificacion->descripcion_documento_sector = $value['descripcion_ds'];
                    $detalle_dosificacion->codigo_actividad_documento_sector = $value['codigo_actividad_ds'];
                    $detalle_dosificacion->tipo_factura_documento_sector = $value['tipo_factura_cc'];
                    $detalle_dosificacion->documento_sector_id = $value['codigo_clasificador_ds'];
                    $detalle_dosificacion->dosificacion_empresa_id = $value['empresa_id'];
                    $detalle_dosificacion->save();
                }

                DB::commit();
                session()->forget('dosificaciones_sucursales_detalle');

                return responseJson('Asignado Exitosamente', $dosificacion_empresa, 200);

            }

        } catch (\Exception $e) {
            DB::rollBack();

            return responseJson('Server Error', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ], 500);
        }
    }

    public function edit($id)
    {
        $dosificacionEmpresa = DosificacionEmpresa::find($id);

        return view('dosificaciones_empresas.edit', compact('dosificacionEmpresa'));
    }

    public function getDataDocumentoSector(Request $request)
    {
        try {
            $dataDocumentoSector = [];
            $documentoSectorID = $request->documento_sector_id;
            $tipoDocumentoSector = ImpuestoTipoDocumentoSector::where('codigo_documento_sector', $documentoSectorID)->first();
            $tipoFacturaDocumentoSector = ImpuestoTipoFactura::where('codigo_clasificador', $documentoSectorID)->first();
            $documentoSector = ImpuestoDocumentoSector::where('codigo_clasificador', $documentoSectorID)->first();

            if ($tipoDocumentoSector == null || $tipoFacturaDocumentoSector == null || $documentoSector == null) {
                return responseJson('No se pudo Obtener Informacion Impuesto', null, 400);
            }

            $dataDocumentoSector = [
                'empresa_id' => $request->empresa_id,
                'empresa_nombre' => $request->empresa_nombre,
                'codigo_clasificador_ds' => $documentoSectorID,
                'codigo_actividad_ds' => $tipoDocumentoSector->codigo_actividad,
                'tipo_factura_ds' => $tipoFacturaDocumentoSector->descripcion,
                'tipo_factura_cc' => $tipoFacturaDocumentoSector->codigo_clasificador,
                'descripcion_ds' => $documentoSector->descripcion,
            ];

            session()->get('dosificaciones_sucursales_detalle');
            $verificarDSAgregado = $this->verificarDocumentoSectorAgregado($documentoSectorID);
            if (! $verificarDSAgregado) { //? False = No existe ese DS en la session
                session()->push('dosificaciones_sucursales_detalle', $dataDocumentoSector);

                return responseJson('Data DS Encountered', session()->get('dosificaciones_sucursales_detalle'), 200);
            }

            return responseJson('DS Ya esta Agregado', session()->get('dosificaciones_sucursales_detalle'), 400);

        } catch (\Exception $e) {
            return responseJson('Server Error', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ], 500);
        }
    }

    public function eliminarDetalle(Request $request)
    {

        $detalle_dosificaciones = session('dosificaciones_sucursales_detalle');
        unset($detalle_dosificaciones[$request->data]);
        session()->put('dosificaciones_sucursales_detalle', $detalle_dosificaciones);

        return responseJson('Session Actualizada', session()->get('dosificaciones_sucursales_detalle'), 200);

    }

    public function verificarDocumentoSectorAgregado($documentoSectorID)
    {
        if (! empty(session()->get('dosificaciones_sucursales_detalle'))) {
            foreach (session('dosificaciones_sucursales_detalle') as $key => $value) {
                if ($value['codigo_clasificador_ds'] == $documentoSectorID) {
                    return true;
                }
            }
        }

        return false;
    }
}
