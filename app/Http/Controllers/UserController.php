<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function usersList()
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "User"], ['name' => "Users List"]
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('pages.page-users-list', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
    }
    public function usersView()
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "User"], ['name' => "Users View"]
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('pages.page-users-view', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
    }
    public function usersEdit()
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "User"], ['name' => "Users Edit"]
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];
        return view('pages.page-users-edit', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
    }

    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function asignarEmpresaUser($id)
    {
        $user = User::find($id);
        $empresas = Empresa::all();

        return view('users.asignarEmpresaUser', compact('user', 'empresas'));
    }

    public function saveAsignarEmpresaUser(Request $request)
    {
        try {

            $user = User::find($request->user_id);
            $user->empresas()->sync($request->empresas);

            $user->save();
            if ($user->save()) {
                return responseJson('Empresa Asignada Exitosamente', $user->empresas , 200);
            }else{
                return responseJson('Something went Wrong', $user->empresas,400);
            }

        } catch (\Exception $e) {
            return responseJson('Server Error',[
                'message'=> $e->getMessage(),
                'code'=> $e->getCode(),
            ],500);
        }
    }
}
