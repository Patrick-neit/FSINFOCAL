@extends('layouts.contentLayoutMaster')

@section('title', 'SubFamilias')

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
        <a href="#modalCrearSubFamilia" id="crearSubFamilia"
            class="btn waves-effect waves-light invoice-create border-round z-depth-4 modal-trigger">
            <i class="material-icons">add</i>
            <span class="hide-on-small-only">Crear SubFamilia</span>
        </a>
    </div>
    <div class="responsive-table">
        <table class="table invoice-data-table white border-radius-4 pt-1">
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th>Nombre Sub Familia</th>
                    <th>Familia</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($sub_familias as $sub_familia)
                <tr>
                    <td></td>
                    <td></td>
                    <td>{{ $sub_familia->nombre_sub_familia }}</td>
                    <td>{{ $sub_familia->familia?->nombre_familia }}</td>
                    <td>
                        @if ($sub_familia->estado)
                        <span class="badge badge pill green">Activo</span>
                        @else
                        <span class="badge badge pill red">Inactivo</span>
                        @endif
                    </td>
                    <td>
                        <a href="#modalCrearSubFamilia" id="editarSubFamilia"
                            class="btn btn-floating orange modal-trigger" data-sub_familia="{{ $sub_familia }}"
                            title="Editar SubFamilia">
                            <i class="material-icons">edit</i>
                        </a>
                        <a href="#modalEliminar" id="eliminarSubFamilia" class="btn btn-floating red modal-trigger"
                            data-id="{{ $sub_familia->id }}" title="Eliminar SubFamilia">
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
    @include('sub_familia.modals.form')
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
    let ruta_index_sub_familia = "{{ route('sub_familia.index') }}";
    let ruta_update_sub_familia = "{{ route('sub_familia.update') }}";
    let ruta_guardar_sub_familia = "{{ route('sub_familia.store') }}";
    let ruta_eliminar_sub_familia = "{{ route('sub_familia.destroy') }}";
</script>
<script src="{{asset('js/scripts/advance-ui-modals.js')}}"></script>
<script src="{{ asset('js/scripts/sub_familia/index.js') }}"></script>
<script src="{{ asset('js/scripts/sub_familia/create.js') }}"></script>
<script src="{{ asset('js/scripts/sub_familia/edit.js') }}"></script>
<script src="{{ asset('js/scripts/sub_familia/destroy.js') }}"></script>
@endsection