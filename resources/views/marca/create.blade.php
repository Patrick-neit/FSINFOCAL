{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Nueva marca')

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
                        <i class="material-icons mr-1">person_outline</i><span>Gestión marca</span>
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
                                        <input id="nombre_marca" name="nombre_marca" type="text" class="validate"
                                            value="@if (isset($marca)){{ $marca->nombre_marca }}@else{{old('nombre_marca')}}@endif"
                                            data-error=".errorTxt1" required>
                                        <label for="nombre_marca">Nombre marca</label>
                                        <small class="errorTxt1"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6">
                                <div class="row">
                                    <div class="col s12 input-field">
                                        <select class="form-control" name="estado" id="estado">
                                            <option @if (isset($marca)) @if ($marca->estado == 1)
                                                selected
                                                @endif
                                                @endif value="1">Activo</option>
                                            <option @if (isset($marca)) @if ($marca->estado == 0)
                                                selected
                                                @endif
                                                @endif
                                                value="0">Inactivo</option>
                                        </select>
                                        <label>Estado</label>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="id_marca" name="id_marca"
                                value="@if(isset($marca)){{ $marca->id }}@endif">

                            <div class="col s12 display-flex justify-content-end mt-3">
                                <button id="registrarMarcaButton" class="btn indigo mr-2">Guardar</button>
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
<script src="{{asset('js/scripts/marca/create.js')}}"></script>
<script>
    let ruta_guardar_marca = "{{route('marca.store')}}";
    let ruta_index_marca   = "{{route('marca.index')}}";
    let ruta_eliminar_marca = "{{route('marca.destroy')}}";
</script>
@endsection