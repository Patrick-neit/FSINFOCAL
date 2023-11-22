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
        <div class="row center-align">
            <div class="input-field col s3">
            </div>
            <div class="input-field col s6 center-align">
                <a href="{{ route('login') }}">
                    <img class="circle responsive-img" src="{{ asset('images/logo/logorda.png') }}"
                        alt="Logo RDA CONSULTORES">
                </a>
            </div>
            <div class="input-field col s3">
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <h5 class="ml-4">Iniciar Sesión</h5>
            </div>
            <div class="input-field col s2 center">
                <h5 class="ml-4"> -&nbsp;&oacute;&nbsp;-</h5>
            </div>
            <div class="input-field col s4 center">
                <a href="{{ route('auth.google.redirect') }}">
                    <h5 class="ml-4">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="40" height="40"
                            viewBox="0 0 48 48">
                            <path fill="#fbc02d"
                                d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12	s5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24s8.955,20,20,20	s20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z">
                            </path>
                            <path fill="#e53935"
                                d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039	l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z">
                            </path>
                            <path fill="#4caf50"
                                d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36	c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z">
                            </path>
                            <path fill="#1565c0"
                                d="M43.611,20.083L43.595,20L42,20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571	c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z">
                            </path>
                        </svg>
                    </h5>
                </a>
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