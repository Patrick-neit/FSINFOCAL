@extends('layouts.contentLayoutMaster')

@section('title', 'Empresas')

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
        <a href="#modalCrearEmpresa" id="crearEmpresa"
            class="btn waves-effect waves-light invoice-create border-round z-depth-4 modal-trigger">
            <i class="material-icons">add</i>
            <span class="hide-on-small-only">Crear Empresa</span>
        </a>
    </div>
    <div class="responsive-table">
        <table class="table invoice-data-table white border-radius-4 pt-1">
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th>Id</th>
                    <th>Nombre Empresa</th>
                    <th>Identificacion Tributaria</th>
                    <th>Telefono</th>
                    <th>Representante Legal</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($empresas as $empresa)
                <tr>
                    <td></td>
                    <td></td>
                    <td>{{ $empresa->id }}</td>
                    <td>{{ $empresa->nombre_empresa }}</td>
                    <td>{{ $empresa->nro_nit_empresa }}</td>
                    <td>+ 591 {{ $empresa->telefono }}</td>
                    <td>{{ $empresa->representante_legal }}</td>
                    <td>
                        <a href="#modalCrearEmpresa" id="editarEmpresa" class="btn btn-floating orange modal-trigger"
                            data-empresa="{{ $empresa }}" title="Editar Empresa">
                            <i class="material-icons">edit</i>
                        </a>
                        <a href="#modalEliminar" id="eliminarEmpresa" class="btn btn-floating red modal-trigger"
                            data-id="{{ $empresa->id }}" title="Eliminar Empresa">
                            <i class="material-icons delete">delete</i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @include('common.modalConfirmDelete')
    @include('empresas.modals.form')
</section>
@endsection

@section('vendor-script')
<script src="{{asset('vendors/data-tables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('vendors/data-tables/js/datatables.checkboxes.min.js')}}"></script>
@endsection

@section('page-script')
<script>
    let ruta_index_empresa = "{{ route('empresas.index') }}";
    let ruta_guardar_empresa = "{{ route('empresas.store') }}"
    let ruta_eliminar_empresa = "{{ route('empresas.destroy') }}";
</script>
<script src="{{asset('js/scripts/advance-ui-modals.js')}}"></script>
<script src="{{ asset('js/scripts/empresas/index.js') }}"></script>
<script src="{{ asset('js/scripts/empresas/create.js') }}"></script>
<script src="{{ asset('js/scripts/empresas/edit.js') }}"></script>
<script src="{{ asset('js/scripts/empresas/destroy.js') }}"></script>
@endsection