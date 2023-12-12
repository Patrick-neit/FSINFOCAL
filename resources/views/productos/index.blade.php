{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title', 'Listado Empresas')

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
                                    <a href="{{ route('producto.create') }}"
                                        class="btn waves-effect waves-light invoice-create border-round z-depth-4">
                                        <i class="material-icons">add</i>
                                        <span class="hide-on-small-only">Crear producto</span>
                                    </a>
                                </div> <br>
                            </div>
                        </div>
                    </div>

                    <table id="enterprice-list-datatable" class="table">
                        <thead>
                            <tr>
                                <th>C&oacute;digo Producto</th>
                                <th>Nombre producto</th>
                                <th>Caracteristica</th>
                                <th>Stock Actual</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($productos as $producto)
                            <tr>
                                <td>{{ $producto->codigo_producto }}</td>
                                <td>{{ $producto->nombre_producto }}</td>
                                <td>{{ empty($producto->caracteristicas) ? 'Ninguno': $producto->caracteristicas }}</td>
                                <td>10</td>
                                {{-- <td>{{\App\Models\InventarioAlmacen::where('producto_id',
                                    $producto->id)->get()[0]->stock_actual}}</td> --}}
                                <td>{{ $producto->estado }}</td>
                                <td class="text-center">
                                    <a href="{{ route('producto.edit', $producto->id)}}">
                                        <i class="material-icons">edit</i>
                                    </a>
                                    <span><a style="cursor: pointer;" onclick="eliminar('{{ $producto->id }}')"><i
                                                class="material-icons">delete_outline</i></a></span>
                                </td>
                                {{-- <td><a href="{{ asset('page-users-view') }}"><i
                                            class="material-icons">remove_red_eye</i></a></td> --}}
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center">
                                    No hay registros para mostrar
                                </td>
                            </tr>
                            @endforelse
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
<script src="{{ asset('js/scripts/productos/index.js') }}"></script>
<script>
    let ruta_index_producto = "{{ route('producto.index') }}";
    let ruta_eliminar_producto = "{{ route('producto.destroy') }}";
</script>
@endsection
