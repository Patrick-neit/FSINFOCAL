@extends('layouts.contentLayoutMaster')

@section('title', 'Familias')

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
        <a href="#modalCrearFamilia" id="crearFamilia"
            class="btn waves-effect waves-light invoice-create border-round z-depth-4 modal-trigger">
            <i class="material-icons">add</i>
            <span class="hide-on-small-only">Crear Familia</span>
        </a>
    </div>
    <div class="responsive-table">
        <table class="table invoice-data-table white border-radius-4 pt-1">
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th>Nombre familia</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($familias as $familia)
                <tr>
                    <td></td>
                    <td></td>
                    <td>{{ $familia->nombre_familia }}</td>
                    <td>
                        @if ($familia->estado)
                        <span class="badge badge pill green">Activo</span>
                        @else
                        <span class="badge badge pill red">Inactivo</span>
                        @endif
                    </td>
                    <td>
                        <a href="#modalCrearFamilia" id="editarFamilia" class="btn btn-floating orange modal-trigger"
                            data-familia="{{ $familia }}" title="Editar Familia">
                            <i class="material-icons">edit</i>
                        </a>
                        <a href="#modalEliminar" id="eliminarFamilia" class="btn btn-floating red modal-trigger"
                            data-id="{{ $familia->id }}" title="Eliminar Familia">
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
    @include('familia.modals.form')
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
    let ruta_index_familia = "{{ route('familia.index') }}";
    let ruta_update_familia = "{{ route('familia.update') }}";
    let ruta_guardar_familia = "{{ route('familia.store') }}";
    let ruta_eliminar_familia = "{{ route('familia.destroy') }}";
</script>
<script src="{{asset('js/scripts/advance-ui-modals.js')}}"></script>
<script src="{{ asset('js/scripts/familia/index.js') }}"></script>
<script src="{{ asset('js/scripts/familia/create.js') }}"></script>
<script src="{{ asset('js/scripts/familia/edit.js') }}"></script>
<script src="{{ asset('js/scripts/familia/destroy.js') }}"></script>
@endsection