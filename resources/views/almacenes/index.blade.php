@extends('layouts.page')

@section('title', 'Almacenes')

@section('create-action-content')
<a href="#modalCrearAlmacen" id="crearAlmacen"
    class="btn waves-effect waves-light invoice-create border-round z-depth-4 modal-trigger">
    <i class="material-icons">add</i>
    <span class="hide-on-small-only">Crear Almacen</span>
</a>
@endsection

@section('table-content')
<table aria-describedby="Almacenes" class="table invoice-data-table white border-radius-4 pt-1">
    <thead>
        <tr>
            <th></th>
            <th></th>
            <th>Nombre Almacen</th>
            <th>Capacidad</th>
            <th>Sucursal Asociada</th>
            <th>Encargado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($almacenes as $almacen)
        <tr>
            <td></td>
            <td></td>
            <td>{{ $almacen->nombre }}</td>
            <td>{{ $almacen->capacidad_almacen }}</td>
            <td>{{ $almacen->sucursal?->nombre_sucursal }}</td>
            <td>{{ $almacen->encargado->name }}</td>
            <td>
                <a href="#modalCrearAlmacen" id="editarAlmacen" class="btn btn-floating orange modal-trigger"
                    data-almacen="{{ $almacen }}" title="Editar Almacen">
                    <i class="material-icons">edit</i>
                </a>
                <a href="#modalEliminar" id="eliminar" class="btn btn-floating red modal-trigger"
                    data-id="{{ $almacen->id }}" title="Eliminar Almacen">
                    <i class="material-icons delete">delete</i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('additional-components')
@include('almacenes.modals.form')
@endsection

@section('page-custom-scripts')
<script>
    //For Table
    let numberColumns = 7;
    let searchString = 'Buscar Almacen';
    //For Destroy
    let key_id ='almacen_id';
    //For Edit
    let almacen_id = null;
</script>
<script>
    let ruta_guardar_almacen = "{{ route('almacenes.store') }}"
    let ruta_index = "{{ route('almacenes.index') }}";
    let ruta_eliminar = "{{ route('almacenes.destroy') }}";
</script>
<script>
    let nombre = document.getElementById("nombre");
    let capacidad_almacen = document.getElementById("capacidad_almacen");
    let encargado_id = document.getElementById("encargado_id");
    let sucursal_id = document.getElementById("sucursal_id");
</script>
<script src="{{ asset('js/scripts/almacenes/submitForm.js') }}"></script>
<script src="{{ asset('js/scripts/almacenes/create.js') }}"></script>
<script src="{{ asset('js/scripts/almacenes/edit.js') }}"></script>
@endsection