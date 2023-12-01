{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title', 'Listado Puntos Ventas')

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
                                        <span class="hide-on-small-only">Sincronizar Nuevo PV</span>
                                    </a>
                                </div> <br>
                            </div>
                        </div>
                    </div>

                    <table id="users-list-datatable" class="table">
                        <thead>
                            <tr>
                                <th>Tipo Punto Venta</th>
                                <th>Descripcion Punto Venta</th>
                                <th>Personal Asociado</th>
                                <th>Sucursal Asociada</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($puntosVentas as $puntoVenta)
                            <tr>
                                <td>{{ $puntoVenta->codigo_punto_venta }}</td>
                                <td> <span class="green-text">{{ $puntoVenta->descripcion_punto_venta }}</span>
                                    </span> </td>
                                <td>{{$puntoVenta->user->name}} </td>
                                <td> <span class="red-text">{{$puntoVenta->sucursal->nombre_sucursal}}</span> </td>
                                <td>
                                    <a href="{{ asset('page-users-view') }}"><i class="material-icons">cached</i></a>
                                    <span><a onclick="eliminar('{{ $puntoVenta->id }}')"><i
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
<script src="{{ asset('js/scripts/puntos_ventas/index.js') }}"></script>
<script>

</script>
@endsection