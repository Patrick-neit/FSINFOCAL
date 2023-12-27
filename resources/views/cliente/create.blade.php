{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Nueva cliente')

{{-- vendor styles --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2-materialize.css')}}">
@endsection

{{-- page style --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/page-users.css')}}">
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
                        <i class="material-icons mr-1">person_outline</i><span>Gestión cliente</span>
                    </a>
                </li>
            </ul>
            <div class="divider mb-3"></div>
            <div class="row">
                @csrf
                <div class="col s12 m6 l6 input-field">
                    <input id="nombre_cliente" name="nombre_cliente" type="text" class="validate"
                        value="@if (isset($cliente)){{ $cliente->nombre_cliente }}@else{{old('nombre_cliente')}}@endif"
                        data-error=".errorTxt1" required>
                    <label for="nombre_cliente">Nombre cliente</label>
                    <small class="errorTxt1"></small>
                </div>
                <div class="col s12 m6 l6 input-field">
                    <select class="form-control" name="documento" id="documento">
                        @foreach ($documentos as $documento)
                        <option value="{{ $documento->codigo_clasificador }}">{{
                            $documento->descripcion }}</option>
                        @endforeach
                    </select>
                    <label>Tipo Documento</label>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m6 l6 input-field">
                    <input id="numero_nit" name="numero_nit" type="text" class="validate"
                        value="@if (isset($cliente)){{ $cliente->numero_nit }}@else{{old('numero_nit')}}@endif"
                        data-error=".errorTxt1" required>
                    <label for="numero_nit">Nro Nit</label>
                    <small class="errorTxt1"></small>
                </div>
                <div class="col s12 m6 l6 input-field">
                    <input id="complemento" name="complemento" type="text" class="validate"
                        value="@if (isset($cliente)){{ $cliente->complemento }}@else{{old('complemento')}}@endif"
                        data-error=".errorTxt1" required>
                    <label for="complemento">Complemento</label>
                    <small class="errorTxt1"></small>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m6 l6 input-field">
                    <input id="direccion" name="direccion" type="text" class="validate"
                        value="@if (isset($cliente)){{ $cliente->direccion }}@else{{old('direccion')}}@endif"
                        data-error=".errorTxt1" required>
                    <label for="direccion">Direccion</label>
                    <small class="errorTxt1"></small>
                </div>
                <div class="col s12 m6 l6 input-field">
                    <input id="telefono" name="telefono" type="text" class="validate"
                        value="@if (isset($cliente)){{ $cliente->telefono }}@else{{old('telefono')}}@endif"
                        data-error=".errorTxt1" required>
                    <label for="telefono">Telefono</label>
                    <small class="errorTxt1"></small>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m6 l6 input-field">
                    <input id="correo" name="correo" type="text" class="validate"
                        value="@if (isset($cliente)){{ $cliente->correo }}@else{{old('correo')}}@endif"
                        data-error=".errorTxt1" required>
                    <label for="correo">Correo</label>
                    <small class="errorTxt1"></small>
                </div>
                <div class="col s12 m6 l6 input-field">
                    <select id="departamento_id" class="form-control">
                        <option value="1">La Paz</option>
                        <option value="2">Cochabamba</option>
                        <option value="3">Santa Cruz</option>
                        <option value="4">Oruro</option>
                        <option value="5">Potosi</option>
                        <option value="6">Tarija</option>
                        <option value="7">Beni</option>
                        <option value="8">Pando</option>
                        <option value="9">Chuquisaca</option>
                    </select>
                    <label for="departamento_id">Departamento</label>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m6 l6 input-field">
                    <input id="fecha_cumpleanos" name="fecha_cumpleanos" type="text" class="datepicker"
                        value="@if (isset($cliente)){{ $cliente->fecha_cumpleanos }}@endif">
                    <label for="correo">Fecha Cumpleaños</label>
                    <small class="errorTxt1"></small>
                </div>
                <div class="col s12 m6 l6 input-field">
                    <input id="contacto" name="contacto" type="text" class="validate"
                        value="@if (isset($cliente)){{ $cliente->contacto }}@else{{old('contacto')}}@endif"
                        data-error=".errorTxt1" required>
                    <label for="contacto">Contacto</label>
                    <small class="errorTxt1"></small>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m6 l6 input-field">
                    <select class="form-control" name="tipos_precios" id="tipos_precios">
                        @foreach (\App\Enums\TiposPrecios::cases() as $case)
                        <option @if (isset($cliente)) @if ($case->value == $cliente->tipos_precios)
                            selected
                            @endif
                            @endif
                            value="{{ $case->value }}">{{ $case->name }}</option>

                        @endforeach
                    </select>
                    <label>Tipos Precios</label>
                </div>
                <div class="col s12 m6 l6 input-field">
                    <select class="form-control" name="estado" id="estado">
                        <option @if (isset($cliente)) @if ($cliente->estado == 1)
                            selected
                            @endif
                            @endif value="1">Activo</option>
                        <option @if (isset($cliente)) @if ($cliente->estado == 0)
                            selected
                            @endif
                            @endif
                            value="0">Inactivo</option>
                    </select>
                    <label>Estado</label>
                </div>
            </div>
            <input type="hidden" id="id_cliente" name="id_cliente" value="@if(isset($cliente)){{ $cliente->id }}@endif">
            <div class="row">
                <div class="col s12 display-flex justify-content-end mt-3">
                    <button id="registrarClienteButton" class="btn indigo mr-2">Guardar</button>
                    <button type="button" class="btn btn-light">Cancel</button>
                </div>
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
<script src="{{asset('vendors/select2/select2.full.min.js')}}"></script>
<script src="{{asset('vendors/jquery-validation/jquery.validate.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-script')
<script src="{{asset('js/scripts/cliente/create.js')}}"></script>
<script>
    let ruta_guardar_cliente = "{{route('cliente.store')}}";
    let ruta_index_cliente   = "{{route('cliente.index')}}";
    let ruta_eliminar_cliente = "{{route('cliente.destroy')}}";
</script>
@endsection
