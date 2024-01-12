{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title', 'Listado Catalogos Precios')

{{-- vendors styles --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/data-tables/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css"
    href="{{ asset('vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2-materialize.css')}}">
@endsection

{{-- page styles --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{ asset('css/pages/page-users.css') }}">
@endsection

{{-- page content --}}
@section('content')
<!-- users list start -->
<section class="users-list-wrapper section">

    <div class="users-list-table">
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <div class="col s12 m6 l6 input-field">
                        <select name="cliente_id" id="cliente_id" class="select2 browser-default">
                            @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->nombre_cliente }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col s12 m6 l6 input-field">
                        <h6 style="color: red">*Tomar nota para escoger otra opcion, sleccione la opcion actual para
                            editarlo</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m12 l12">
                        <table class="mt-1">
                            <thead>
                                <tr>
                                    <th>Productos Activas</th>
                                    <th>Precio A</th>
                                    <th>Precio B</th>
                                    <th>Precio C</th>
                                    <th>Precio D</th>
                                    <th>Precio E</th>
                                    <th>Precio F</th>
                                    <th>Precio G</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productos as $producto)
                                <tr>
                                    <td>{{$producto->nombre_producto}}</td>
                                    <input type="hidden" name="productos[]" class="producto-checkbox"
                                        value="{{$producto->id}}" />
                                    <td>
                                        <label>
                                            <input id="check_a_{{$producto->id}}" type="checkbox"
                                                name="precio_a_{{$producto->id}}" class="precio-checkbox" value="1"
                                                onclick="blockCheck({{ $producto->id }})"

                                            />
                                            <span></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input id="check_b_{{$producto->id}}" type="checkbox"
                                                name="precio_b_{{$producto->id}}" class="precio-checkbox" value="1"
                                                onclick="blockCheck({{ $producto->id }})"

                                            />
                                            <span></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input id="check_c_{{$producto->id}}" type="checkbox"
                                                name="precio_c_{{$producto->id}}" class="precio-checkbox" value="1"
                                                onclick="blockCheck({{ $producto->id }})"

                                            />
                                            <span></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input id="check_d_{{$producto->id}}" type="checkbox"
                                                name="precio_d_{{$producto->id}}" class="precio-checkbox" value="1"
                                                onclick="blockCheck({{ $producto->id }})"

                                            />
                                            <span></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input id="check_e_{{$producto->id}}" type="checkbox"
                                                name="precio_e_{{$producto->id}}" class="precio-checkbox" value="1"
                                                onclick="blockCheck({{ $producto->id }})"

                                            />
                                            <span></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input id="check_f_{{$producto->id}}" type="checkbox"
                                                name="precio_f_{{$producto->id}}" class="precio-checkbox" value="1"
                                                onclick="blockCheck({{ $producto->id }})"

                                            />
                                            <span></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input id="check_g_{{$producto->id}}" type="checkbox"
                                                name="precio_g_{{$producto->id}}" class="precio-checkbox" value="1"
                                                onclick="blockCheck({{ $producto->id }})"

                                            />
                                            <span></span>
                                        </label>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- </div> -->
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 display-flex justify-content-end mt-3">
                        <button id="asignarPrecioButton" class="btn indigo mr-2">Actualizar</button>
                    </div>
                </div>
            </div>
        </div>
</section>
<!-- users list ends -->
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
<script src="{{ asset('vendors/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('vendors/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('vendors/data-tables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js') }}"></script>
@endsection

{{-- page script --}}
@section('page-script')
<script src="{{ asset('js/scripts/catalogos_precios/index.js') }}"></script>
<script>
    let ruta_store_catalogos = "{{ route('catalogos_productos.tipo_precio_store') }}"
</script>
@endsection
