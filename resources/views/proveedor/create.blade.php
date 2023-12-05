{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Nueva proveedor')

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
                        <i class="material-icons mr-1">person_outline</i><span>Gestión proveedor</span>
                    </a>
                </li>
            </ul>
            <div class="divider mb-3"></div>
            <div class="row">
                <div class="col s12" id="account">
                    <!-- users edit account form start -->
                    <form>
                        @csrf
                        <div class="row">
                            <div class="col s12 m6">
                                <div class="row">
                                    <div class="col s12 input-field">
                                        <input id="nombre_proveedor" name="nombre_proveedor" type="text"
                                            class="validate"
                                            value="@if (isset($proveedor)){{ $proveedor->nombre_proveedor }}@else{{old('nombre_proveedor')}}@endif"
                                            data-error=".errorTxt1" required>
                                        <label for="nombre_proveedor">Nombre proveedor</label>
                                        <small class="errorTxt1"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6">
                                <div class="row">
                                    <div class="col s12 input-field">
                                        <input id="direccion" name="direccion" type="text" class="validate"
                                            value="@if (isset($proveedor)){{ $proveedor->direccion }}@else{{old('direccion')}}@endif"
                                            data-error=".errorTxt1" required>
                                        <label for="direccion">Direcci&oacute;n</label>
                                        <small class="errorTxt1"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6">
                                <div class="row">
                                    <div class="col s12 input-field">
                                        <input id="telefono" name="telefono" type="text" class="validate"
                                            value="@if (isset($proveedor)){{ $proveedor->telefono }}@else{{old('telefono')}}@endif"
                                            data-error=".errorTxt1" required>
                                        <label for="telefono">Tel&eacute;fono</label>
                                        <small class="errorTxt1"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6">
                                <div class="row">
                                    <div class="col s12 input-field">
                                        <input id="rubro" name="rubro" type="text" class="validate"
                                            value="@if (isset($proveedor)){{ $proveedor->rubro }}@else{{old('rubro')}}@endif"
                                            data-error=".errorTxt1" required>
                                        <label for="rubro">Rubro</label>
                                        <small class="errorTxt1"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6">
                                <div class="row">
                                    <div class="col s12 input-field">
                                        <select class="form-control" name="documentoIdentidad" id="documentoIdentidad">
                                            @forelse ($tipoDocumentos as $tipoDocumento)
                                            <option @if (isset($proveedor)) @if ($proveedor->tipo_documento ==
                                                $tipoDocumento->codigo_clasificador)
                                                selected
                                                @endif
                                                @endif
                                                value="{{ $tipoDocumento->codigo_clasificador }}">{{
                                                $tipoDocumento->descripcion }}</option>
                                            @empty
                                            <option value="">Sin opciones</option>
                                            @endforelse
                                        </select>
                                        <label>Tipo Documento</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6">
                                <div class="row">
                                    <div class="col s12 input-field">
                                        <input id="numero_documento" name="numero_documento" type="text"
                                            class="validate"
                                            value="@if (isset($proveedor)){{ $proveedor->numero_nit }}@else{{old('numero_documento')}}@endif"
                                            data-error=".errorTxt1" required>
                                        <label for="numero_documento">Numero Documento</label>
                                        <small class="errorTxt1"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6">
                                <div class="row">
                                    <div class="col s12 input-field">
                                        <input id="correo" name="correo" type="email" class="validate"
                                            value="@if (isset($proveedor)){{ $proveedor->correo }}@else{{old('correo')}}@endif"
                                            data-error=".errorTxt1" required>
                                        <label for="correo">Correo</label>
                                        <small class="errorTxt1"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6">
                                <div class="row">
                                    <div class="col s12 input-field">
                                        <input id="contacto" name="contacto" type="text" class="validate"
                                            value="@if (isset($proveedor)){{ $proveedor->contacto }}@else{{old('contacto')}}@endif"
                                            data-error=".errorTxt1" required>
                                        <label for="contacto">Contacto</label>
                                        <small class="errorTxt1"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6">
                                <div class="row">
                                    <div class="col s12 input-field">
                                        <select class="form-control" name="sucursal_id" id="sucursal_id">
                                            @forelse ($sucursales as $sucursal)
                                            <option @if (isset($proveedor)) @if ($proveedor->sucursal_id ==
                                                $sucursal->id)
                                                selected
                                                @endif
                                                @endif
                                                value="{{ $sucursal->id }}">{{ $sucursal->nombre_sucursal }}
                                            </option>
                                            @empty
                                            <option value="">Sin opciones</option>
                                            @endforelse
                                        </select>
                                        <label>Sucursal</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6">
                                <div class="row">
                                    <div class="col s12 input-field">
                                        <select class="form-control" name="estado" id="estado">
                                            <option @if (isset($proveedor)) @if ($proveedor->estado == 1)
                                                selected
                                                @endif
                                                @endif value="1">Activo</option>
                                            <option @if (isset($proveedor)) @if ($proveedor->estado == 0)
                                                selected
                                                @endif
                                                @endif
                                                value="0">Inactivo</option>
                                        </select>
                                        <label>Estado</label>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="id_proveedor" name="id_proveedor"
                                value="@if(isset($proveedor)){{ $proveedor->id }}@endif">

                            <div class="col s12 display-flex justify-content-end mt-3">
                                <button id="registrarProveedorButton" class="btn indigo mr-2">Guardar</button>
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
<script src="{{asset('vendors/select2/select2.full.min.js')}}"></script>
<script src="{{asset('vendors/jquery-validation/jquery.validate.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-script')
<script src="{{asset('js/scripts/proveedor/create.js')}}"></script>
<script>
    let ruta_guardar_proveedor = "{{route('proveedor.store')}}";
    let ruta_index_proveedor   = "{{route('proveedor.index')}}";
    let ruta_eliminar_proveedor = "{{route('proveedor.destroy')}}";
</script>
@endsection