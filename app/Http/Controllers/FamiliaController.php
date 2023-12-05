<?php

namespace App\Http\Controllers;

use App\Models\Familia;
use Illuminate\Http\Request;

class FamiliaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $familias = Familia::all();

        return view('familia.index', compact('familias'));
    }

    public function create()
    {
        return view('familia.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            if (! empty($request->familia_id)) {
                return $this->update($request);
            }
            $familia = new Familia();
            $familia->nombre_familia = $request->nombre_familia;
            $familia->estado = $request->estado;
            $familia->save();

            return responseJson('Familia Creada.', $familia, 200);
        } catch (\Exception $e) {
            return responseJson('Server Error', $e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Familia  $familia
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $familia = Familia::find($id);

        return view('familia.create', compact('familia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Familia  $familia
     * @return \Illuminate\Http\Response
     */
    public function update($request)
    {
        try {
            $familia = Familia::find($request->familia_id);
            $familia->nombre_familia = $request->nombre_familia;
            $familia->estado = $request->estado;
            $familia->save();

            return responseJson('Familia Actualizada', $familia, 200);
        } catch (\Exception $e) {
            return responseJson('Server Error', $e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Familia  $familia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            $familia = Familia::find($request->familia_id);
            $familia->delete();
            if ($familia->trashed()) {
                return responseJson('Eliminado Exitosamente', $familia, 200);
            }
        } catch (\Exception $e) {
            return responseJson('Server Error', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ], 500);
        }
    }
}
