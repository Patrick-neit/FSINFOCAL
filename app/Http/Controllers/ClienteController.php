<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\ClienteTipoPrecio;
use App\Models\ImpuestoDocumentoIdentidad;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cliente.index', [
            'clientes' => Cliente::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cliente.create', [
            'documentos' => ImpuestoDocumentoIdentidad::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            if (!empty($request->cliente_id)) {
                return $this->update($request);
            }
            $cliente = new Cliente();
            $cliente->nombre_cliente = $request->nombre_cliente;
            $cliente->tipo_documento_id = $request->documento;
            $cliente->numero_nit = $request->numero_nit;
            $cliente->complemento = $request->complemento;
            $cliente->direccion = $request->direccion;
            $cliente->telefono = $request->telefono;
            $cliente->correo = $request->correo;
            $cliente->tipo_precio = $request->tipos_precios;
            $cliente->departamento_id = $request->departamento_id;
            $cliente->fecha_cumpleanos = Carbon::createFromFormat('d/m/Y', $request->fecha_cumpleanos)->format('Y-m-d');

            $cliente->contacto = $request->contacto;
            $cliente->save();
            if ($cliente->save()) {

                selectTipoPrecio($request->tipos_precios, $cliente->id);

                return responseJson('Cliente Guardado', $cliente, 200);
            }
        } catch (\Exception $e) {
            return responseJson('Server Error', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('cliente.create', [
            'cliente' => Cliente::find($id)->load('impuestos_documentos_identidad'),
            'documentos' => ImpuestoDocumentoIdentidad::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update($request)
    {
        try {
            $cliente = Cliente::find($request->cliente_id);
            $cliente->nombre_cliente = $request->nombre_cliente;
            $cliente->tipo_documento_id = $request->documento;
            $cliente->numero_nit = $request->numero_nit;
            $cliente->complemento = $request->complemento;
            $cliente->direccion = $request->direccion;
            $cliente->telefono = $request->telefono;
            $cliente->correo = $request->correo;
            $cliente->departamento_id = $request->departamento_id;
            $cliente->fecha_cumpleanos = Carbon::parse($request->fecha_cumpleanos)->format('Y-m-d');
            $cliente->contacto = $request->contacto;
            $cliente->save();

            return responseJson('Cliente Actualizado.', $cliente, 200);
        } catch (\Exception $e) {
            return responseJson('Server Error', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            $cliente = Cliente::find($request->cliente_id);
            $cliente->delete();
            if ($cliente->trashed()) {
                return responseJson('Eliminado Exitosamente', $cliente, 200);
            }
        } catch (\Exception $e) {
            return responseJson('Server Error', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ], 500);
        }
    }
}
