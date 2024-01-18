@extends('layouts.contentLayoutMaster')

@section('title', 'Categorias')

@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css"
    href="{{asset('vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/css/dataTables.checkboxes.css')}}">
@endsection

@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-invoice.css')}}">
@endsection

@section('content')
<section class="invoice-list-wrapper section">
    <div class="invoice-create-btn">
        <a href="#modalCrearCategoria" id="crearCategoria"
            class="btn waves-effect waves-light invoice-create border-round z-depth-4 modal-trigger">
            <i class="material-icons">add</i>
            <span class="hide-on-small-only">Crear Categoria</span>
        </a>
    </div>
    <div class="responsive-table">
        <table class="table invoice-data-table white border-radius-4 pt-1">
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th>Nombre Categoria</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categorias as $categoria)
                <tr>
                    <td></td>
                    <td></td>
                    <td>{{ $categoria->nombre_categoria }}</td>
                    <td>
                        @if ($categoria->estado)
                        <span class="badge badge pill green">Activo</span>
                        @else
                        <span class="badge badge pill red">Inactivo</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="#modalCrearCategoria" id="editarCategoria"
                            class="btn btn-floating orange modal-trigger" data-categoria="{{ $categoria }}"
                            title="Editar Categoria">
                            <i class="material-icons">edit</i>
                        </a>
                        <a href="#modalEliminar" id="eliminarCategoria" class="btn btn-floating red modal-trigger"
                            data-id="{{ $categoria->id }}" title="Eliminar Categoria">
                            <i class="material-icons delete">delete</i>
                        </a>
                    </td>
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
    @include('common.modalConfirmDelete')
    @include('categoria.modals.form')
</section>

@endsection

{{-- vendor scripts --}}
@section('vendor-script')
<script src="{{asset('vendors/data-tables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('vendors/data-tables/js/datatables.checkboxes.min.js')}}"></script>
@endsection

{{-- page script --}}
@section('page-script')
<script>
    let ruta_index_categoria = "{{ route('categoria.index') }}";
    let ruta_update_categoria = "{{ route('categoria.update') }}";
    let ruta_guardar_categoria = "{{ route('categoria.store') }}";
    let ruta_eliminar_categoria = "{{ route('categoria.destroy') }}";
</script>
<script src="{{asset('js/scripts/advance-ui-modals.js')}}"></script>
<script src="{{ asset('js/scripts/categoria/index.js') }}"></script>
<script src="{{ asset('js/scripts/categoria/create.js') }}"></script>
<script src="{{ asset('js/scripts/categoria/edit.js') }}"></script>
<script src="{{ asset('js/scripts/categoria/destroy.js') }}"></script>
@endsection