<?php

namespace App\Http\Controllers;

use App\Models\Familia;
use App\Models\SubFamilia;
use Illuminate\Http\Request;

class SubFamiliaController extends Controller
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
            ['link' => 'javascript:void(0)', 'name' => 'SubFamilias'],
        ];
        $pageConfigs = [
            'pageHeader' => true,
            'isFabButton' => true
        ];
        $familias = Familia::all();
        $sub_familias = SubFamilia::all();
        return view('sub_familia.index', [
            'sub_familias' => $sub_familias,
            'familias' => $familias,
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
        return view('sub_familia.create', [
            'familias' => Familia::all(),
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
            if (!empty($request->sub_familia_id)) {
                return $this->update($request);
            }
            $subFamilia = new SubFamilia();
            $subFamilia->nombre_sub_familia = $request->nombre_sub_familia;
            $subFamilia->familia_id = $request->familia_id;
            $subFamilia->estado = $request->estado;
            $subFamilia->save();

            return responseJson('Sub Familia Guardada.', $subFamilia, 200);
        } catch (\Exception $e) {
            return responseJson('Server Error', $e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(SubFamilia $subFamilia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubFamilia  $subFamilia
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('sub_familia.create', [
            'sub_familia' => SubFamilia::find($id)->load('familia'),
            'familias' => Familia::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubFamilia  $subFamilia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $subFamilia = SubFamilia::find($request->sub_familia_id);
            $subFamilia->nombre_sub_familia = $request->nombre_sub_familia;
            $subFamilia->familia_id = $request->familia_id;
            $subFamilia->estado = $request->estado;
            $subFamilia->save();

            return responseJson('Sub Familia Actualizado.', $subFamilia, 200);
        } catch (\Exception $e) {
            return responseJson('Server Error', $e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubFamilia  $subFamilia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            $subFamilia = SubFamilia::find($request->sub_familia_id);
            $subFamilia->delete();
            if ($subFamilia->trashed()) {
                return responseJson('Eliminado Exitosamente', $subFamilia, 200);
            }
        } catch (\Exception $e) {
            return responseJson('Server Error', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ], 500);
        }
    }
}
