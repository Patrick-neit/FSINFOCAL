<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            ['link' => 'home', 'name' => 'Home'],
            ['link' => 'javascript:void(0)', 'name' => 'Marcas'],
        ];
        $pageConfigs = [
            'pageHeader' => true,
            'isFabButton' => true
        ];
        $marcas = Marca::where('estado', 1)->get();

        return view('marca.index', [
            'marcas' => $marcas,
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    public function create()
    {
        return view('marca.create');
    }

    public function edit($id)
    {
        $marca = Marca::find($id);

        return view('marca.create', compact('marca'));
    }

    public function store(Request $request)
    {
        try {
            if (!empty($request->marca_id)) {
                return $this->update($request, $request->marca_id);
            }
            $marca = new Marca();
            $marca->nombre_marca = $request->nombre_marca;
            $marca->estado = $request->estado;
            $marca->save();

            return responseJson('Guardado Exitosamente', $marca, 200);
        } catch (\Exception $e) {
            return responseJson('Server Error', $e->getMessage(), 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $marca = Marca::find($id);
            $marca->nombre_marca = $request->nombre_marca;
            $marca->estado = $request->estado;
            $marca->save();

            return responseJson('Actualizado Exitosamente', $marca, 200);
        } catch (\Exception $e) {
            return responseJson('Server Error', $e->getMessage(), 500);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $marca = Marca::find($request->marca_id);
            $marca->delete();
            if ($marca->trashed()) {
                return responseJson('Eliminado Exitosamente', $marca, 200);
            }
        } catch (\Exception $e) {
            return responseJson('Server Error', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ], 500);
        }
    }
}
