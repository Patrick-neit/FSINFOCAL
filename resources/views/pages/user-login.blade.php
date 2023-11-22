{{-- layout --}}
@extends('layouts.fullLayoutMaster')

{{-- page title --}}
@section('title','User Login')

{{-- page style --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/login.css')}}">
@endsection

{{-- page content --}}
@section('content')
<div id="login-page" class="row">
    <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 login-card bg-opacity-8">

        <div class="row">
            <div class="input-field col s12">
                <h5 class="ml-4">Iniciar Sesión</h5>
            </div>
        </div>
        <div class="row margin">
            <div class="input-field col s12">
                <i class="material-icons prefix pt-2">person_outline</i>
                <input id="email" type="text">
                <label for="email" class="center-align">Correo</label>
            </div>
        </div>
        <div class="row margin">
            <div class="input-field col s12">
                <i class="material-icons prefix pt-2">lock_outline</i>
                <input id="password" type="password">
                <label for="password">Contrase&#241;a</label>
            </div>
        </div>
        {{-- <div class="row">
            <div class="col s12 m12 l12 ml-2 mt-1">
                <p>
                    <label>
                        <input type="checkbox" />
                        <span>Remember Me</span>
                    </label>
                </p>
            </div>
        </div> --}}
        <div class="row">
            <div class="input-field col s12">
                <a id="loginUser"
                    class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">Acceder</a>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6 m6 l6">
                {{-- <p class="margin medium-small"><a href="{{asset('user-register')}}">Register Now!</a></p> --}}
            </div>
            <div class="input-field col s6 m6 l6">
                <p class="margin right-align medium-small"><a href="{{asset('user-forgot-password')}}">Olvidaste tu
                        contrase&#241;a?</a>
                </p>
            </div>
        </div>

    </div>
</div>
@endsection

{{-- page scripts --}}
@section('page-script')
<script src="{{asset('js/scripts/user_auth/userLoginAuthentification.js')}}"></script>
<script>
    let ruta_logear_user = "{{route('autentification.login')}}";
    let ruta_index_dashboard   = "{{route('dashboard.dashboardModern')}}";
</script>
@endsection