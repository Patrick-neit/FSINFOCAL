{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title', 'Nuevo Punto Venta')

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
                        <i class="material-icons mr-1">person_outline</i><span>Almacenes</span>
                    </a>
                </li>
            </ul>
            <div class="divider mb-3"></div>
            <div class="row">
                <div class="col s12" id="account">
                    <!-- users edit account form start -->
                    <form>
                        <div class="row">

                            <div class="col s12 m6">
                                <div class="row">
                                    <div class="col s12 input-field">
                                        <input id="nombre_almacen" name="nombre_almacen" type="text"
                                            class="validate" value="{{ old('nombre_almacen') }}"
                                            data-error=".errorTxt1" required>
                                        <label for="nombre_almacen">Nombre Almacen</label>
                                        <small class="errorTxt1"></small>
                                    </div>
                                    <div class="col s12 input-field">
                                        <select name="sucursal_id" id="sucursal_id" class="form-select">
                                            @foreach ($sucursales as $sucursal)
                                            <option value="{{ $sucursal->id }}">{{ $sucursal->nombre_sucursal }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <label>Asociar Sucursal</label>
                                    </div>

                                </div>
                            </div>
                            <div class="col s12 m6">
                                <div class="col s12 input-field">
                                    <input id="capacidad_almacen" name="capacidad_almacen" type="number"
                                        class="validate" value="{{ old('capacidad_almacen') }}"
                                        data-error=".errorTxt2" required>
                                    <label for="capacidad_almacen">Capacidad Almacen</label>
                                    <small class="errorTxt2"></small>
                                </div>
                            </div>
                            <div class="col s12 m6">
                                <div class="row">
                                    <div class="col s6 input-field">

                                        <select name="encargado_id" id="encargado_id" class="select2 browser-default">
                                            @foreach ($encargados as $encargado)
                                            <option value="{{ $encargado->id }}">{{ $encargado->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <label>Asociar Encargado</label>
                                    </div>
                                </div>
                            </div>
                            {{-- LOADER --}}

                            <div id="loadingIndicator" class="preloader-wrapper big active" style="display: none;">
                                <div class="spinner-layer spinner-blue">
                                    <div class="circle-clipper left">
                                        <div class="circle"></div>
                                    </div>
                                    <div class="gap-patch">
                                        <div class="circle"></div>
                                    </div>
                                    <div class="circle-clipper right">
                                        <div class="circle"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col s12 display-flex justify-content-end mt-3">
                                <button id="registrarAlmacen" class="btn indigo mr-2">
                                    Registrar Almacen</button>
                                <button type="button" class="btn btn-light">Cancel</button>
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
<script src="{{ asset('js/scripts/almacenes/create.js') }}"></script>
<script>
    let ruta_guardar_almacenes = "{{ route('almacenes.store') }}";
    let ruta_index_almacenes = "{{ route('almacenes.index') }}";
</script>
@endsection
