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
                                    <a href="{{ route('pedido.create') }}"
                                        class="btn waves-effect waves-light invoice-create border-round z-depth-4">
                                        <i class="material-icons">add</i>
                                        <span class="hide-on-small-only">Crear Pedido</span>
                                    </a>
                                </div> <br>
                            </div>
                        </div>
                    </div>

                    <table id="enterprice-list-datatable" class="table">
                        <thead>
                            <tr>
                                <th>C&oacute;digo pedido</th>
                                <th>Descripci&oacute;n</th>
                                <th>Estado Aprobaci&oacute;n</th>
                                <th>Total</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pedidos as $pedido)
                            @if ($pedido->aprobado == 'Pendiente')
                            <tr>
                                <td>{{ $pedido->id }}</td>
                                <td>{{ $pedido->nota }}</td>
                                <td>{{ $pedido->aprobado }}</td>
                                <td>{{ $pedido->total }}</td>
                                <td class="text-center">
                                    <a href="{{ route('compras.aprobar_index', $pedido) }}">
                                        <i class="material-icons">call_merge</i>
                                    </a>
                                    <a href="{{ route('pedido.edit', $pedido->id)}}">
                                        <i class="material-icons">edit</i>
                                    </a>
                                    <span><a style="cursor: pointer;" onclick="eliminar('{{ $pedido->id }}')"><i
                                                class="material-icons">delete_outline</i></a></span>
                                </td>
                            </tr>
                            @endif
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
<script src="{{ asset('js/scripts/pedidos/index.js') }}"></script>
<script>
    let ruta_index_pedido = "{{ route('pedido.index') }}";
    let ruta_eliminar_pedido = "{{ route('pedido.destroy') }}";
    let ruta_aprobar_pedido = "{{ route('compras.aprobar_pedido') }}";
</script>
@endsection