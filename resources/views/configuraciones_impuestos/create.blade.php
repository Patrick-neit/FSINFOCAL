{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title', 'Nueva Configuracion Impuesto')

{{-- vendor styles --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/select2/select2-materialize.css') }}">
@endsection

{{-- page style --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{ asset('css/pages/page-users.css') }}">
@endsection

{{-- page content --}}
@section('content')
<!-- users edit start -->
<div class="section users-edit">
    <div class="card">
        <div class="card-content">
            <!-- <div class="card-body"> -->
            <ul class="tabs mb-2 row">
                <li class="tab">
                    <a class="display-flex align-items-center active" id="account-tab" href="#account">
                        <i class="material-icons mr-1">person_outline</i><span>Configuraci&oacute;n Impuesto</span>
                    </a>
                </li>
                {{-- <li class="tab">
                    <a class="display-flex align-items-center" id="information-tab" href="#information">
                        <i class="material-icons mr-2">error_outline</i><span>Information</span>
                    </a>
                </li> --}}
            </ul>
            <div class="divider mb-3"></div>
            <div class="row">
                <div class="col s12" id="account">
                    <!-- users edit media object start -->
                    {{-- <div class="media display-flex align-items-center mb-2">
                        <a class="mr-2" href="#">
                            <img src="{{ asset('images/avatar/avatar-11.png') }}" alt="users avatar"
                                class="z-depth-4 circle" height="64" width="64">
                        </a>
                        <div class="media-body">
                            <h5 class="media-heading mt-0">Configuracion Impuesto</h5>
                            <div class="user-edit-btns display-flex">
                                <a href="#" class="btn-small indigo">Change</a>
                                <a href="#" class="btn-small btn-light-pink">Reset</a>
                            </div>
                        </div>
                    </div> --}}
                    <!-- users edit media object ends -->
                    <!-- users edit account form start -->
                    <form>
                        <div class="row">

                            <div class="col s12 m6">
                                <div class="row">
                                    <div class="col s12 input-field">
                                        <input id="nombre_sistema" name="nombre_sistema" type="text" class="validate"
                                            value="@if(isset($conf)) {{ $conf->nombre_sistema }} @else {{ old('nombre_sistema') }} @endif"
                                            data-error=".errorTxt1" required>
                                        <label for="nombre_sistema">Nombre Sistema</label>
                                        <small class="errorTxt1"></small>
                                    </div>
                                    <div class="col s12 input-field">
                                        <input id="codigo_sistema" name="codigo_sistema" type="text" class="validate"
                                            value="@if (isset($conf)) {{ $conf->codigo_sistema }} @else {{ old('codigo_sistema') }} @endif"
                                            data-error=".errorTxt2" required>
                                        <label for="codigo_sistema">Codigo Sistema</label>
                                        <small class="errorTxt2"></small>
                                    </div>

                                </div>
                            </div>

                            <div class="col s12 m6">
                                <div class="row">
                                    <div class="input-field col s12">
                                        <select id="modalidad">
                                            <option value="" disabled selected>Elije una opción</option>
                                            <option @if (isset($conf)) @if ($conf->modalidad == 1)
                                                selected
                                                @endif
                                                @endif value="1">Electr&oacute;nica en L&iacute;nea</option>
                                            <option @if (isset($conf)) @if ($conf->modalidad == 2)
                                                selected
                                                @endif
                                                @endif value="2">Computarizada en L&iacute;nea</option>
                                        </select>
                                        <label> Selecciona Modalidad</label>
                                    </div>

                                    <div class="input-field col s12">
                                        <select id="ambiente">
                                            <option value="" disabled selected>Elije una opción</option>
                                            <option @if (isset($conf)) @if ($conf->ambiente == 1)
                                                selected
                                                @endif
                                                @endif value="1">Produccion </option>
                                            <option @if (isset($conf)) @if ($conf->ambiente == 2)
                                                selected
                                                @endif
                                                @endif value="2">Pruebas</option>
                                        </select>
                                        <label> Selecciona Ambiente</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col s12 m6">
                                <div class="row">
                                    <div class="col s12 input-field">
                                        <textarea id="token_sistema" name="token_sistema"
                                            class="materialize-textarea">@if (isset($conf)) {{ $conf->token_sistema
                                            }}@endif</textarea>
                                        <label for="token_sistema">Token Sistema</label>
                                        <small class="errorTxt3"></small>
                                    </div>

                                </div>

                            </div>

                            <div class="col s12 m6">
                                <div class="col s12 input-field">
                                    <select name="empresa_id" id="empresa_id" class="form-select" disabled>
                                        @foreach ($enterprises as $enterprise)
                                        <option @if (isset($conf)) @if ($conf->empresa_id == $enterprise->id)
                                            selected
                                            @endif
                                            @endif
                                            value="{{ $enterprise->id }}">{{ $enterprise->nombre_empresa }}</option>
                                        @endforeach
                                    </select>
                                    <label>Asociar Empresa</label>
                                </div>
                            </div>

                            <div class="col s12 m12">
                                <div class="row">
                                    {{-- <div class="col s12 input-field">
                                        <select>
                                            <option>User</option>
                                            <option>Staff</option>
                                        </select>
                                        <label>Role</label>
                                    </div> --}}

                                    <div class="col s12 input-field">
                                        <select class="form-control" name="estado" id="estado">
                                            <option @if (isset($conf)) @if ($conf->estado == 1)
                                                selected
                                                @endif
                                                @endif value="1">Activo</option>
                                            <option @if (isset($conf)) @if ($conf   ->estado == 0)
                                                selected
                                                @endif
                                                @endif
                                                value="0">Inactivo</option>
                                        </select>
                                        <label>Estado</label>
                                    </div>

                                </div>
                            </div>
                            <input type="hidden" id="id_conf" name="id" value="@if(isset($conf)){{ $conf->id }}@endif">
                            <div class="col s12 display-flex justify-content-end mt-3">
                                <button id="registrarConfiguracionImpuestoButton"
                                    class="btn indigo mr-2">Guardar</button>
                                <button type="button" class="btn btn-light">Cancelar</button>
                            </div>
                        </div>

                    </form>
                    <!-- users edit account form ends -->
                </div>
            </div>
            <!-- </div> -->
        </div>
    </div>
</div>
<!-- users edit ends -->
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
<script src="{{ asset('vendors/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('vendors/jquery-validation/jquery.validate.min.js') }}"></script>
@endsection

{{-- page scripts --}}
@section('page-script')
<script src="{{ asset('js/scripts/configuraciones_impuestos/create.js') }}"></script>
<script>
    let ruta_guardar_configuraciones_impuestos = "{{ route('configuraciones_impuestos.store') }}";
        let ruta_index_configuraciones_impuestos = "{{ route('configuraciones_impuestos.index') }}";
        let ruta_eliminar_configuraciones_impuestos = "{{ route('configuraciones_impuestos.destroy') }}";
</script>
@endsection
