{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title', 'Listado Almacenes')

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
                                    <a href="{{ route('almacenes.create') }}"
                                        class="btn waves-effect waves-light invoice-create border-round z-depth-4">
                                        <i class="material-icons">add</i>
                                        <span class="hide-on-small-only">Registrar Nuevo Almacen</span>
                                    </a>
                                </div> <br>
                            </div>
                        </div>
                    </div>

                    <table id="users-list-datatable" class="table">
                        <thead>
                            <tr>
                                <th>Nombre Almacen</th>
                                <th>Capacidad</th>
                                <th>Sucursal Asociada</th>
                                <th>Encargado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($almacenes as $almacen)
                            <tr>
                                <td>{{ $almacen->nombre }}</td>
                                <td> <span class="green-text">{{ $almacen->capacidad_almacen }}</span>
                                    </span> </td>

                                <td> <span class="red-text">{{$almacen->sucursal->nombre_sucursal}}</span> </td>
                                <td> <span class="red-text">{{$almacen->encargado->name}}</span> </td>
                                <td>
                                    <a href="{{ asset('page-users-view') }}"><i class="material-icons">cached</i></a>
                                    <span><a onclick="eliminar('{{ $almacen->id }}')"><i
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
<script src="{{ asset('js/scripts/almacenes/index.js') }}"></script>
<script>
    let ruta_index_almacenes = "{{ route('almacenes.index') }}";
    let ruta_delete_almacen = "{{ route('almacenes.destroy') }}";
</script>
<script>

</script>
@endsection
