<?php

namespace App\Http\Controllers;

use App\Mail\SendMailReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use DB;
use Carbon\Carbon;
use Mail;

class AuthenticationController extends Controller
{

    public function enviarRecuperarContrasenia(Request $request)
    {
        // Validación del email
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        // Generamos un token único
        $token = Str::random(64);

        User::where('email', $request->email)->update(['remember_token' => $token]);

        // Eliminamos la anterior reseteo de contraseña sin terminar
        /* DB::table('password_reset_tokens')->where(['email' => $request->email])->delete(); */

        // Creamos la solicitud de reseteo de contraseña
        /* DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]); */


        // Enviamos el email de recuperación de contraseña
        Mail::to($request->email)->send(new SendMailReset($token, $request->email));

        return responseJson('Te hemos enviado un email con las instrucciones para que recuperes tu contraseña', [], 200);
    }
    /**
     * Función que devuelve la vista con el formulario que actualiza la contraseña
     *
     * @return response()
     */
    public function formularioActualizacion($token)
    {
        return view('auth.passwords.reset', ['token' => $token]);
    }

    /**
     * Función que actualiza la contraseña del usuario
     *
     * @return response()
     */
    public function actualizarContrasenia(Request $request)
    {
        // Validaciones
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        // Obtenemos el registro que contiene la solicitud de reseteo de contraseña
        /* $updatePassword = DB::table('password_reset_tokens')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])
            ->first(); */

        // Si no existe la solicitud devolvemos un error
        /* if (!$updatePassword) {
            return back()->withInput()->with('error', 'Token inválido');
        } */

        // Actualizamos la contraseña del usuario
        $user = User::where('email', $request->email)
            ->where('remember_token', $request->token)->first();

        if (!$user) {
            return responseJson('Uusario o token invalidos', [], 500);
        }
        // Eliminamos la solicitud
        /* DB::table('password_reset_tokens')->where(['email' => $request->email])->delete(); */

        // Devolvemos al formulario de login (devolvera un 404 puesto que no existe la ruta)
        $user->update([
            'password' => Hash::make($request->password),
            'remember_token' => null
        ]);
        return responseJson('Contrasena actualizada', [], 200);
    }

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
