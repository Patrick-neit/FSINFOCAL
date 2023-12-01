<?php

namespace App\Http\Controllers;

use App\Models\Correlativo;
use App\Models\Empresa;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SucursalController extends Controller
{
    protected $documento = [
        '0' => 'Factura',
        '1' => 'Boleta',
        '2' => 'NotaVenta',
    ];

    protected $serie = [
        '0' => 'F-000',
        '1' => 'B-000',
        '2' => 'NV-000',
    ];

    public function index()
    {
        $branches = Sucursal::where('empresa_id', Auth::user()->empresas[0]->id)->get();

        return view('sucursales.index', compact('branches'));
    }

    public function edit($id)
    {
        $empresas = Empresa::where('id', Auth::user()->empresas[0]->id)->get();
        $sucursal = Sucursal::find($id);

        return view('sucursales.create', compact('sucursal', 'empresas'));
    }

    public function create()
    {
        $empresas = Empresa::where('id', Auth::user()->empresas[0]->id)->get();

        return view('sucursales.create', compact('empresas'));
    }

    public function store(Request $request)
    {
        try {
            if (!empty($request->sucursal_id)) {
                return $this->update($request);
            }
            $branch = new Sucursal();
            $branch->nombre_sucursal = $request->nombre_sucursal;
            $branch->direccion = $request->direccion;
            $branch->codigo_sucursal = $request->codigo_sucursal;
            $branch->telefono = $request->telefono;
            $branch->empresa_id = $request->empresa_id;
            $branch->save();
            if ($branch->save()) {
                for ($i = 0; $i < 3; $i++) {
                    Correlativo::create([
                        'sucursal_id' => $branch->id,
                        'documento' => $this->documento[$i],
                        'serie' => $this->serie[$i],
                        'numero' => 1,
                    ]);
                }

                return responseJson('Registrado Exitosamente', $branch, 200);
            } else {
                return responseJson('Something went Wrong', $branch, 400);
            }
        } catch (\Exception $e) {
            return responseJson('Server Error', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ], 500);
        }
    }

    public function update($request)
    {
        try {
            $branch = Sucursal::find($request->sucursal_id);
            $branch->nombre_sucursal = $request->nombre_sucursal;
            $branch->direccion = $request->direccion;
            $branch->codigo_sucursal = $request->codigo_sucursal;
            $branch->telefono = $request->telefono;
            $branch->save();
            if ($branch->save()) {
                return responseJson('Actualizado Exitosamente', $branch, 200);
            } else {
                return responseJson('Something went Wrong', $branch, 400);
            }
        } catch (\Exception $e) {
            return responseJson('Server Error', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ], 500);
        }
    }

    public function destroy(Request $request)
    {
        try {

            $branch = Sucursal::find($request->sucursal_id);
            $branch->delete();

            if ($branch->trashed()) {
                return responseJson('Eliminado Exitosamente', $branch, 200);
            }
        } catch (\Exception $e) {
            return responseJson('Server Error', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ], 500);
        }
    }
}
