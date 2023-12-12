{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title', 'Listado Tipos Precios')

{{-- vendors styles --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/data-tables/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css"
    href="{{ asset('vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css') }}">
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
                <!-- datatable start -->
                <div class="responsive-table">
                    <div class="row">
                        <div class="col s12">
                            <div class="right-align">
                                <!-- create invoice button-->
                                <div class="invoice-create-btn">
                                    <a href="{{ route('puntos_ventas.create') }}"
                                        class="btn waves-effect waves-light invoice-create border-round z-depth-4">
                                        <i class="material-icons">add</i>
                                        <span class="hide-on-small-only">Nuevo Tipo Precio</span>
                                    </a>
                                </div> <br>
                            </div>
                        </div>
                    </div>

                    <table id="users-list-datatable" class="table">
                        <thead>
                            <tr>
                                <th>Fecha Sincronizacion</th>
                                <th>Cliente Sincronizado</th>
                                <th>Tipo Precio Sincronizado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tipoPreciosClientes as $tipoPrecio)
                            <tr>
                                <td>{{ $tipoPrecio->created_at }}</td>
                                <td> <span class="green-text">{{ $tipoPrecio->cliente->nombre_cliente }}</span>
                                    </span> </td>

                                <td>
                                    @if ($tipoPrecio->tipo_precio_a = 1)
                                        <span class="red-text">TIPO PRECIO A</span>
                                    @elseif ($tipoPrecio->tipo_precio_b = 1)
                                        <span class="red-text">TIPO PRECIO B</span>
                                    @elseif ($tipoPrecio->tipo_precio_c = 1)
                                        <span class="red-text">TIPO PRECIO C</span>
                                    @else
                                    <span class="red-text">TIPO PRECIO D</span>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ asset('page-users-view') }}"><i class="material-icons">cached</i></a>
                                    <span><a onclick="eliminar('{{ $tipoPrecio->id }}')"><i
                                                class="material-icons">delete_outline</i></a></span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- datatable ends -->
            </div>
        </div>
    </div>
</section>
<!-- users list ends -->
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
<script src="{{ asset('vendors/data-tables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js') }}"></script>
@endsection

{{-- page script --}}
@section('page-script')
<script src="{{ asset('js/scripts/tipos_precios/index.js') }}"></script>
<script>

</script>
@endsection
