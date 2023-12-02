{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title', 'Nueva Sucursal')

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
                        <i class="material-icons mr-1">person_outline</i><span>Sucursal</span>
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
                                        <input id="nombre_sucursal" name="nombre_sucursal" type="text" class="validate"
                                            value="@if (isset($sucursal)){{ $sucursal->nombre_sucursal }}@else{{old('nombre_sucursal')}}@endif"
                                            data-error=".errorTxt1" required>
                                        <label for="nombre_sucursal">Nombre Sucursal</label>
                                        <small class="errorTxt1"></small>
                                    </div>
                                    <div class="col s12 input-field">
                                        <input id="direccion" name="direccion" type="text" class="validate"
                                            value="@if (isset($sucursal)){{ $sucursal->direccion }}@else{{old('direccion')}}@endif"
                                            data-error=".errorTxt2" required>
                                        <label for="direccion">Direccion</label>
                                        <small class="errorTxt2"></small>
                                    </div>

                                </div>
                            </div>
                            <input type="hidden" id="id_sucursal" name="id_empresa"
                                value="@if(isset($sucursal)){{ $sucursal->id }}@endif">
                            <div class="col s12 m6">
                                <div class="row">

                                    <div class="col s12 input-field">
                                        <input id="codigo_sucursal" name="codigo_sucursal" type="number"
                                            class="validate"
                                            value="@if (isset($sucursal)){{ $sucursal->codigo_sucursal }}@else{{old('codigo_sucursal')}}@endif"
                                            data-error=".errorTxt3" required @if (isset($sucursal)) disabled @endif>
                                        <label for="codigo_sucursal">Codigo Sucursal</label>
                                        <small class="errorTxt3"></small>
                                    </div>
                                    <div class="col s12 input-field">
                                        <input id="telefono" name="telefono" type="number" class="validate"
                                            value="@if (isset($sucursal)){{ $sucursal->telefono }}@else{{old('telefono')}}@endif"
                                            data-error=".errorTxt1" required>
                                        <label for="telefono">Telefono</label>
                                        <small class="errorTxt1"></small>
                                    </div>
                                </div>
                            </div>

                            <div class="col s12 m12">
                                <div class="row">
                                    <div class="col s12 input-field">
                                        <select name="empresa_id" id="empresa_id" class="form-select">
                                            @foreach ($empresas as $empresa )
                                            <option value="{{$empresa->id}}">{{$empresa->nombre_empresa}}</option>
                                            @endforeach
                                        </select>
                                        <label>Asociar Empresa</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 display-flex justify-content-end mt-3">
                                <button id="registrarSucursalButton" class="btn indigo mr-2">Guardar</button>
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
<script src="{{ asset('js/scripts/sucursales/create.js') }}"></script>
<script>
    let ruta_guardar_sucursal = "{{ route('sucursales.store') }}";
        let ruta_index_sucursal = "{{ route('sucursales.index') }}";
        let ruta_eliminar_sucursal = "{{ route('sucursales.destroy') }}";
</script>
@endsection