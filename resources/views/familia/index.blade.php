@extends('layouts.page')

@section('title', 'Familias')

@section('create-action-content')
<a href="#modalCrearFamilia" id="crearFamilia"
    class="btn waves-effect waves-light invoice-create border-round z-depth-4 modal-trigger">
    <i class="material-icons">add</i>
    <span class="hide-on-small-only">Crear Familia</span>
</a>
@endsection

@section('table-content')
<table aria-describedby="familias" class="table invoice-data-table white border-radius-4 pt-1">
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
        @foreach ($familias as $familia)
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
                <a href="#modalEliminar" id="eliminar" class="btn btn-floating red modal-trigger"
                    data-id="{{ $familia->id }}" title="Eliminar Familia">
                    <i class="material-icons delete">delete</i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('additional-components')
@include('familia.modals.form')
@endsection

@section('page-custom-scripts')
<script>
    //For Table
    let numberColumns = 5;
    let searchString = 'Buscar Familia';
    //For Destroy
    let key_id ='familia_id';
    //For Edit
    let familia_id = null;
</script>
<script>
    let ruta_update_familia = "{{ route('familia.update') }}";
    let ruta_guardar_familia = "{{ route('familia.store') }}";
    let ruta_index = "{{ route('familia.index') }}";
    let ruta_eliminar = "{{ route('familia.destroy') }}";
</script>
<script>
    let nombre_familia = document.getElementById("nombre_familia");
    let estado = document.getElementById("estado");
</script>
<script src="{{ asset('js/scripts/familia/submitForm.js') }}"></script>
<script src="{{ asset('js/scripts/familia/create.js') }}"></script>
<script src="{{ asset('js/scripts/familia/edit.js') }}"></script>
@endsection