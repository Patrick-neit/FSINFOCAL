{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title', 'Listado Sucursales')

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
                                    <a href="{{ route('sucursales.create') }}"
                                        class="btn waves-effect waves-light invoice-create border-round z-depth-4">
                                        <i class="material-icons">add</i>
                                        <span class="hide-on-small-only">Crear Sucursal</span>
                                    </a>
                                </div> <br>
                            </div>
                        </div>
                    </div>

                    <table id="users-list-datatable" class="table">

                        <thead>
                            <tr>

                                <th>Nombre Sucursal</th>
                                <th>Direccion</th>
                                <th>Codigo Sucursal</th>
                                <th>Telefono</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($branches as $branch)
                            <tr>
                                <td><a href="{{ asset('page-users-view') }}">{{ $branch->nombre_sucursal }}</a></td>
                                <td>{{ $branch->direccion }}</td>
                                <td>{{ $branch->codigo_sucursal == 0 ? 'Casa Matriz' : 'Sucursal ' .
                                    $branch->codigo_sucursal }}</td>
                                <td>+ 591 {{ $branch->telefono }}</td>

                                <td>
                                    <a href="{{ route('sucursales.edit', $branch->id) }}"><i
                                            class="material-icons">edit</i></a>
                                    <span><a style="cursor: pointer" onclick="eliminar('{{ $branch->id }}')"><i
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
<script src="{{ asset('js/scripts/sucursales/index.js') }}"></script>
<script>
    let ruta_index_sucursal = "{{ route('sucursales.index') }}";
        let ruta_eliminar_sucursal = "{{ route('sucursales.destroy') }}";
</script>
@endsection