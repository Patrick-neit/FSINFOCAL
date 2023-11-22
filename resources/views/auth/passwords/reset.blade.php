{{-- layout --}}
@extends('layouts.fullLayoutMaster')

{{-- page title --}}
@section('title','Restablecer Contraseña')

{{-- page style --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/login.css')}}">
@endsection

{{-- page content --}}
@section('content')
<div id="login-page" class="row">
    <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 login-card bg-opacity-8">
        <form class="login-form">
            <div class="row">
                <div class="input-field col s12">
                    <h5 class="ml-4">Restablecer contraseña</h5>
                </div>
            </div>
            <input type="hidden" id="token" name="token" value="{{ $token }}">
            <div class="row margin">
                <div class="input-field col s12">
                    <i class="material-icons prefix pt-2">person_outline</i>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ $email ?? old('email') }}" autocomplete="email" autofocus>
                    <label for="email" class="center-align">Correo</label>
                    @error('email')
                    <small class="red-text ml-7" role="alert">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
            </div>
            <div class="row margin">
                <div class="input-field col s12">
                    <i class="material-icons prefix pt-2">lock_outline</i>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" autocomplete="new-password">
                    <label for="password">Contraseña</label>
                    @error('password')
                    <small class="red-text ml-7" role="alert">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
            </div>
            <div class="row margin">
                <div class="input-field col s12">
                    <i class="material-icons prefix pt-2">lock_outline</i>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                        autocomplete="new-password">
                    <label for="password-confirm">Confirmar Contraseña</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <a id="updatePassword"
                        class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">Login</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('page-script')
<script src="{{asset('js/scripts/user_auth/userUpdatePassword.js')}}"></script>
<script>
    let ruta_enviar_recuperacion = "{{route('actualizar-contrasenia')}}";
    let ruta_index_dashboard = "{{route('login')}}";
</script>
@endsection