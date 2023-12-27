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
                        <i class="material-icons mr-1">person_outline</i><span>Editar Tipo Precio para el Cliente</span>
                    </a>
                </li>
            </ul>
            <div class="divider mb-3"></div>
            <div class="row">
                <input type="hidden" id="id_cliente" name="id_cliente" value="{{ $cliente->id }}">
                <div class="col s12 m6 l6 input-field">
                    <input id="name_cliente" name="name_cliente" type="text" class="validate"
                        value="{{ $cliente->nombre_cliente }}" data-error=".errorTxt1" required disabled>
                    <label for="nombre_punto_venta">Cliente</label>
                    <small class="errorTxt1"></small>
                </div>
                <div class="col s12 m6 l6 input-field">
                    <select class="form-control" name="tipos_precios" id="tipos_precios">
                        @foreach (\App\Enums\TiposPrecios::cases() as $case)
                        <option @if (isset($cliente)) @if ($case->value == $cliente->tipo_precio)
                            selected
                            @endif
                            @endif
                            value="{{ $case->value }}">{{ $case->name }}</option>

                        @endforeach
                    </select>
                    <label>Tipos Precios</label>
                </div>
            </div>
            <div class="row">
                <div class="col s12 display-flex justify-content-end mt-3">
                    <button id="actualizarTipoPrecio" class="btn indigo mr-2">Actualizar</button>
                    <button type="button" class="btn btn-light">Cancel</button>
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
<script src="{{ asset('js/scripts/tipos_precios/index.js') }}"></script>
<script>
    let ruta_guardar_tipo_precio = "{{ route('catalogos_productos.tipo_precio_store') }}";
    let ruta_index_tipo_precio = "{{ route('catalogos_productos.tipo_precio_index') }}";
</script>
@endsection