{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Nueva sub_familia')

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
                        <i class="material-icons mr-1">person_outline</i><span>Gestión sub_familia</span>
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
                                        <input id="nombre_sub_familia" name="Nombre Sub Familia" type="text"
                                            class="validate"
                                            value="@if (isset($sub_familia)){{ $sub_familia->nombre_sub_familia }}@else{{old('nombre_sub_familia')}}@endif"
                                            data-error=".errorTxt1" required>
                                        <label for="nombre_sub_familia">Nombre sub_familia</label>
                                        <small class="errorTxt1"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6">
                                <div class="row">
                                    <div class="col s6 input-field">
                                        <select class="form-control" name="familia_id" id="familia_id">
                                            @foreach ($familias as $familia)
                                            <option @if (isset($sub_familia)) @if ($sub_familia->familia_id ==
                                                $familia->id)
                                                selected
                                                @endif
                                                @endif
                                                value="{{ $familia->id }}">{{ $familia->nombre_familia }}</option>
                                            @endforeach
                                        </select>
                                        <label>Familia</label>
                                    </div>
                                    <div class="col s6 input-field">
                                        <select class="form-control" name="estado" id="estado">
                                            <option @if (isset($sub_familia)) @if ($sub_familia->estado == 1)
                                                selected
                                                @endif
                                                @endif value="1">Activo</option>
                                            <option @if (isset($sub_familia)) @if ($sub_familia->estado == 0)
                                                selected
                                                @endif
                                                @endif
                                                value="0">Inactivo</option>
                                        </select>
                                        <label>Estado</label>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="id_sub_familia" name="id_sub_familia"
                                value="@if(isset($sub_familia)){{ $sub_familia->id }}@endif">

                            <div class="col s12 display-flex justify-content-end mt-3">
                                <button id="registrarSubFamiliaButton" class="btn indigo mr-2">Guardar</button>
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
<script src="{{asset('js/scripts/sub_familia/create.js')}}"></script>
<script>
    let ruta_guardar_sub_familia = "{{route('sub_familia.store')}}";
    let ruta_index_sub_familia   = "{{route('sub_familia.index')}}";
    let ruta_eliminar_sub_familia = "{{route('sub_familia.destroy')}}";
</script>
@endsection