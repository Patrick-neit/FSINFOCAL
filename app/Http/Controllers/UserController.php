<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function store(Request $request)
    {
        try {


            if ($request->hasFile('avatar')) {
                $path = Storage::disk('public')->put('avatars', $request->file('avatar'));
            }
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->avatar = '/storage/' . $path;
            $user->estado = $request->estado;
            $user->save();
            if ($user->save()) {
                return responseJson('Registrado Exitosamente', $user, 200);
            } else {
                return responseJson('Something went Wrong', $user, 400);
            }
        } catch (\Exception $e) {
            return responseJson('Server Error', $e->getMessage(), 500);
        }
    }

    public function update(Request $request)
    {
        try {
            if ($request->hasFile('avatar')) {
                $path = Storage::disk('public')->put('avatars', $request->file('avatar'));
            }
            $user = User::find($request->user_id);

            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = empty($request->password) ? Hash::make($request->password) : $user->password;
            $user->avatar = $request->hasFile('avatar') ? '/storage/' . $path : $user->avatar;
            $user->estado = $request->estado;
            $user->save();
            if ($user->save()) {
                return responseJson('Registrado Exitosamente', $user, 200);
            } else {
                return responseJson('Something went Wrong', $user, 400);
            }
        } catch (\Exception $e) {
            return responseJson('Server Error', $e->getMessage(), 500);
        }
    }

    public function show(Request $request)
    {
        $user = User::find($request->user_id);
        return responseJson('Success', $user, 200);
    }
    public function usersList()
    {
        $breadcrumbs = [
            ['link' => 'modern', 'name' => 'Home'], ['link' => 'javascript:void(0)', 'name' => 'User'], ['name' => 'Users List'],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('pages.page-users-list', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
    }

    public function usersView()
    {
        $breadcrumbs = [
            ['link' => 'modern', 'name' => 'Home'], ['link' => 'javascript:void(0)', 'name' => 'User'], ['name' => 'Users View'],
        ];
        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => true];

        return view('pages.page-users-view', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
    }

    public function usersEdit()
    {
        $breadcrumbs = [
            ['link' => 'modern', 'name' => 'Home'], ['link' => 'javascript:void(0)', 'name' => 'User'], ['name' => 'Users Edit'],
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
                return responseJson('Empresa Asignada Exitosamente', $user->empresas, 200);
            } else {
                return responseJson('Something went Wrong', $user->empresas, 400);
            }
        } catch (\Exception $e) {
            return responseJson('Server Error', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ], 500);
        }
    }

    public function deleteUser(Request $request)
    {
        try {
            $user = User::find($request->user_id);
            $user->delete();
            return responseJson('Success', [], 200);
        } catch (\Exception $e) {
            return responseJson('Server Error', [], 500);
        }
    }
}
