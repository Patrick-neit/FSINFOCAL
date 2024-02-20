@extends('layouts.page')

@section('title', 'Sucursales')

@section('create-action-content')
<a href="#modalCrearSucursal" id="crearSucursal"
    class="btn waves-effect waves-light invoice-create border-round z-depth-4 modal-trigger">
    <i class="material-icons">add</i>
    <span class="hide-on-small-only">Crear Sucursal</span>
</a>
@endsection

@section('table-content')
<table aria-describedby="sucursales" class="table invoice-data-table white border-radius-4 pt-1">
    <thead>
        <tr>
            <th></th>
            <th></th>
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
            <td></td>
            <td></td>
            <td>{{ $branch->nombre_sucursal }}</a></td>
            <td>{{ $branch->direccion }}</td>
            <td>{{ $branch->codigo_sucursal == 0 ? 'Casa Matriz' : 'Sucursal ' .
                $branch->codigo_sucursal }}</td>
            <td>+ 591 {{ $branch->telefono }}</td>
            <td>
                <a href="#modalCrearSucursal" id="editarSucursal" class="btn btn-floating orange modal-trigger"
                    data-sucursal="{{ $branch }}" title="Editar Sucursal">
                    <i class="material-icons">edit</i>
                </a>
                <a href="#modalEliminar" id="eliminar" class="btn btn-floating red modal-trigger"
                    data-id="{{ $branch->id }}" title="Eliminar Sucursal">
                    <i class="material-icons delete">delete</i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('additional-components')
@include('sucursales.modals.form')
@endsection

@section('page-custom-scripts')
<script>
    //For Table
    let numberColumns = 7;
    let searchString = 'Buscar Sucursal';
    //For Destroy
    let key_id ='sucursal_id';
    //For Edit
    let sucursal_id = null;
</script>
<script>
    let ruta_guardar_sucursal = "{{ route('sucursales.store') }}"
    let ruta_update_sucursal = "{{ route('sucursales.update','sucursal_id') }}";
    let ruta_index = "{{ route('sucursales.index') }}";
    let ruta_eliminar = "{{ route('sucursales.destroy') }}";
</script>
<script>
    let nombre_sucursal = document.getElementById("nombre_sucursal");
    let direccion = document.getElementById("direccion");
    let codigo_sucursal = document.getElementById("codigo_sucursal");
    let telefono = document.getElementById("telefono");
    let empresa_id = document.getElementById("empresa_id");
</script>
<script src="{{ asset('js/scripts/sucursales/create.js') }}"></script>
<script src="{{ asset('js/scripts/sucursales/edit.js') }}"></script>
<script src="{{ asset('js/scripts/sucursales/submitForm.js') }}"></script>
@endsection