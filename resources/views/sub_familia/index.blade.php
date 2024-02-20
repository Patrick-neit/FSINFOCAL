@extends('layouts.page')

@section('title', 'SubFamilias')

@section('create-action-content')
<a href="#modalCrearSubFamilia" id="crearSubFamilia"
    class="btn waves-effect waves-light invoice-create border-round z-depth-4 modal-trigger">
    <i class="material-icons">add</i>
    <span class="hide-on-small-only">Crear SubFamilia</span>
</a>
@endsection

@section('table-content')
<table aria-describedby="Subfamilias" class="table invoice-data-table white border-radius-4 pt-1">
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
        @foreach ($sub_familias as $sub_familia)
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
                <a href="#modalCrearSubFamilia" id="editarSubFamilia" class="btn btn-floating orange modal-trigger"
                    data-sub_familia="{{ $sub_familia }}" title="Editar SubFamilia">
                    <i class="material-icons">edit</i>
                </a>
                <a href="#modalEliminar" id="eliminar" class="btn btn-floating red modal-trigger"
                    data-id="{{ $sub_familia->id }}" title="Eliminar SubFamilia">
                    <i class="material-icons delete">delete</i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('additional-components')
@include('sub_familia.modals.form')
@endsection

@section('page-custom-scripts')
<script>
    //For Table
    let numberColumns = 6;
    let searchString = 'Buscar SubFamilia';
    //For Destroy
    let key_id ='sub_familia_id';
    //For Edit
    let sub_familia_id = null;
</script>
<script>
    let ruta_update_sub_familia = "{{ route('sub_familia.update') }}";
    let ruta_guardar_sub_familia = "{{ route('sub_familia.store') }}";
    let ruta_index = "{{ route('sub_familia.index') }}";
    let ruta_eliminar = "{{ route('sub_familia.destroy') }}";
</script>
<script>
    let nombre_sub_familia = document.getElementById("nombre_sub_familia");
    let familia_id = document.getElementById("familia_id");
    let estado = document.getElementById("estado");
</script>
<script src="{{ asset('js/scripts/sub_familia/submitForm.js') }}"></script>
<script src="{{ asset('js/scripts/sub_familia/create.js') }}"></script>
<script src="{{ asset('js/scripts/sub_familia/edit.js') }}"></script>
@endsection