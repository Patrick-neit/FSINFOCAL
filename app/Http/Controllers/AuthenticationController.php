<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthenticationController extends Controller
{

    public function redirectLogin()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackLogin()
    {
        $googleUser = Socialite::driver('google')->user();

        $user = User::where('email', $googleUser->email)->first();

        if (!$user) {
            return responseJson('Usuario no encontrado', [], 404);
        }

        $user->update([
            'google_id' => $googleUser->id,
            'google_token' => $googleUser->token,
            'google_refresh_token' => $googleUser->refreshToken,
            'name' => $googleUser->name,
            'email' => $googleUser->email,
            'password' => Hash::make($googleUser->id),
        ]);
        Auth::login($user);

        return responseJson('Logeado Exitosamente. Espere...', $googleUser->email, 200);
    }

    public function userLogin()
    {
        $pageConfigs = ['bodyCustomClass' => 'login-bg', 'isCustomizer' => false];

        return view('pages.user-login', ['pageConfigs' => $pageConfigs]);
    }

    public function userRegister()
    {
        $pageConfigs = ['bodyCustomClass' => 'register-bg', 'isCustomizer' => false];

        return view('pages.user-register', ['pageConfigs' => $pageConfigs]);
    }

    public function forgotPassword()
    {
        $pageConfigs = ['bodyCustomClass' => 'forgot-bg', 'isCustomizer' => false];

        return view('pages.user-forgot-password', ['pageConfigs' => $pageConfigs]);
    }

    public function lockScreen()
    {
        $pageConfigs = ['bodyCustomClass' => 'forgot-bg', 'isCustomizer' => false];

        return view('pages.user-lock-screen', ['pageConfigs' => $pageConfigs]);
    }

    public function login(Request $request)
    {
        try {

            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if (Auth::attempt($credentials)) {
                //TODO: Aqui se añadirá la consulta para obtener el rol del usuario y de acuerdo a eso loquearse
                return responseJson('Logeado Exitosamente. Espere...', $request->email, 200);
            }

            return responseJson('Las credenciales no coinciden con nuestros registros', $request->email, 500);
        } catch (\Exception $e) {
            return responseJson('Server Error', [
                'message' => $e->getMessage(),
                'codde' => $e->getCode(),
            ], 500);
        }
    }

    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
            ]);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return responseJson('Registrado con Exito', $request->name, 200);
        } catch (\Exception $e) {
            return responseJson('Server Error', [
                'message' => $e->getMessage(),
                'codde' => $e->getCode(),
            ], 500);
        }
    }
}
