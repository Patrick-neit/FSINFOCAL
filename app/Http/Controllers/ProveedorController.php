<?php

namespace App\Http\Controllers;

use App\Models\ImpuestoDocumentoIdentidad;
use App\Models\Proveedor;
use App\Models\Sucursal;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = [
            ['link' => 'home', 'name' => 'Home'],
            ['link' => 'javascript:void(0)', 'name' => 'Proveedores'],
        ];
        $pageConfigs = [
            'pageHeader' => true,
            'isFabButton' => true,
        ];

        return view('proveedor.index', [
            'proveedores' => Proveedor::with('sucursal')->get(),
            'sucursales' => Sucursal::all(),
            'tipoDocumentos' => ImpuestoDocumentoIdentidad::all(),
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('proveedor.create', [
            'sucursales' => Sucursal::all(),
            'tipoDocumentos' => ImpuestoDocumentoIdentidad::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! empty($request->proveedor_id)) {
            return $this->update($request);
        }
        $proveedor = new Proveedor();
        $proveedor->nombre_proveedor = $request->nombre_proveedor;
        $proveedor->direccion = $request->direccion;
        $proveedor->telefono = $request->telefono;
        $proveedor->rubro = $request->rubro;
        $proveedor->numero_nit = $request->numero_documento;
        $proveedor->correo = $request->correo;
        $proveedor->contacto = $request->contacto;
        $proveedor->tipo_documento = 1/* $request->documentoIdentidad */;
        $proveedor->sucursal_id = $request->sucursal_id;
        $proveedor->estado = $request->estado;
        $proveedor->save();

        return responseJson('Proveedor Creado.', $proveedor, 200);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Proveedor $proveedor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('proveedor.create', [
            'proveedor' => Proveedor::find($id)->load('sucursal'),
            'sucursales' => Sucursal::all(),
            'tipoDocumentos' => ImpuestoDocumentoIdentidad::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $proveedor = Proveedor::find($request->proveedor_id);
        $proveedor->nombre_proveedor = $request->nombre_proveedor;
        $proveedor->direccion = $request->direccion;
        $proveedor->telefono = $request->telefono;
        $proveedor->rubro = $request->rubro;
        $proveedor->numero_nit = $request->numero_documento;
        $proveedor->correo = $request->correo;
        $proveedor->contacto = $request->contacto;
        $proveedor->tipo_documento = 1/* $request->documentoIdentidad */;
        $proveedor->sucursal_id = $request->sucursal_id;
        $proveedor->estado = $request->estado;
        $proveedor->save();

        return responseJson('Proveedor Actualizado.', $proveedor, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            $proveedor = Proveedor::find($request->proveedor_id);
            $proveedor->delete();
            if ($proveedor->trashed()) {
                return responseJson('Eliminado Exitosamente', $proveedor, 200);
            }
        } catch (\Exception $e) {
            return responseJson('Server Error', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ], 500);
        }
    }
}
