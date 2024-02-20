<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
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
            ['link' => 'javascript:void(0)', 'name' => 'Categorias'],
        ];
        $pageConfigs = [
            'pageHeader' => true,
            'isFabButton' => true
        ];
        $categorias = Categoria::all();
        return view('categoria.index', [
            'categorias' => $categorias,
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categoria.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            if (!empty($request->categoria_id)) {
                return $this->update($request);
            }
            $categoria = new Categoria();
            $categoria->nombre_categoria = $request->nombre_categoria;
            $categoria->estado = $request->estado;
            $categoria->save();

            return responseJson('Categoria Creada.', $categoria, 200);
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
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('categoria.create', [
            'categoria' => Categoria::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $categoria = Categoria::find($request->categoria_id);
            $categoria->nombre_categoria = $request->nombre_categoria;
            $categoria->estado = $request->estado;
            $categoria->save();

            return responseJson('Categoria Actualizada', $categoria, 200);
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
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            $categoria = Categoria::find($request->categoria_id);
            $categoria->delete();
            if ($categoria->trashed()) {
                return responseJson('Eliminado Exitosamente', $categoria, 200);
            }
        } catch (\Exception $e) {
            return responseJson('Server Error', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ], 500);
        }
    }
}
