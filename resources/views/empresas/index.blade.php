@extends('layouts.page')

@section('title', 'Empresas')

@section('create-action-content')
<a href="#modalCrearEmpresa" id="crearEmpresa"
    class="btn waves-effect waves-light invoice-create border-round z-depth-4 modal-trigger">
    <i class="material-icons">add</i>
    <span class="hide-on-small-only">Crear Empresa</span>
</a>
@endsection

@section('table-content')
<table aria-describedby="empresas" class="table invoice-data-table white border-radius-4 pt-1">
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
                <a href="#modalEliminar" id="eliminar" class="btn btn-floating red modal-trigger"
                    data-id="{{ $empresa->id }}" title="Eliminar Empresa">
                    <i class="material-icons delete">delete</i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('additional-components')
@include('empresas.modals.form')
@endsection

@section('page-custom-scripts')
<script>
    //For Table
    let numberColumns = 8;
    let searchString = 'Buscar Empresa';
    //For Destroy
    let key_id ='empresa_id';
    //For Edit
    let empresa_id = null;
</script>
<script>
    let ruta_guardar_empresa = "{{ route('empresas.store') }}"
    let ruta_update_empresa = "{{ route('empresas.update','empresa_id') }}";
    let ruta_index = "{{ route('empresas.index') }}";
    let ruta_eliminar = "{{ route('empresas.destroy') }}";
</script>
<script>
    let nombre_empresa = document.getElementById("nombre_empresa");
    let nro_nit_empresa = document.getElementById("nro_nit_empresa");
    let direccion = document.getElementById("direccion");
    let telefono = document.getElementById("telefono");
    let correo = document.getElementById("correo");
    let logo = document.getElementById("logo");
    let representante_legal = document.getElementById("representante_legal");
    let estado = document.getElementById("estado");
</script>
<script src="{{asset('js/scripts/empresas/submitForm.js')}}"></script>
<script src="{{ asset('js/scripts/empresas/create.js') }}"></script>
<script src="{{ asset('js/scripts/empresas/edit.js') }}"></script>
@endsection