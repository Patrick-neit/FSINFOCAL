@extends('layouts.contentLayoutMaster')

@section('title', 'Marcas')

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
        <a href="#modalCrearMarca" id="crearMarca"
            class="btn waves-effect waves-light invoice-create border-round z-depth-4 modal-trigger">
            <i class="material-icons">add</i>
            <span class="hide-on-small-only">Crear Marca</span>
        </a>
    </div>
    <div class="responsive-table">
        <table class="table invoice-data-table white border-radius-4 pt-1">
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th>Nombre Marca</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($marcas as $marca)
                <tr>
                    <td></td>
                    <td></td>
                    <td>{{ $marca->nombre_marca }}</td>
                    <td>
                        @if ($marca->estado)
                        <span class="badge badge pill green">Activo</span>
                        @else
                        <span class="badge badge pill red">Inactivo</span>
                        @endif
                    </td>
                    <td>
                        <a href="#modalCrearMarca" id="editarMarca" class="btn btn-floating orange modal-trigger"
                            data-marca="{{ $marca }}" title="Editar Marca">
                            <i class="material-icons">edit</i>
                        </a>
                        <a href="#modalEliminar" id="eliminarMarca" class="btn btn-floating red modal-trigger"
                            data-id="{{ $marca->id }}" title="Eliminar Marca">
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
    @include('marca.modals.form')
</section>

<!-- users list ends -->
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
    let ruta_index_marca = "{{ route('marca.index') }}";
    let ruta_update_marca = "{{ route('marca.update', 'marca_id' ) }}";
    let ruta_guardar_marca = "{{ route('marca.store') }}";
    let ruta_eliminar_marca = "{{ route('marca.destroy') }}";
</script>
<script src="{{asset('js/scripts/advance-ui-modals.js')}}"></script>
<script src="{{ asset('js/scripts/marca/index.js') }}"></script>
<script src="{{ asset('js/scripts/marca/create.js') }}"></script>
<script src="{{ asset('js/scripts/marca/edit.js') }}"></script>
<script src="{{ asset('js/scripts/marca/destroy.js') }}"></script>
@endsection