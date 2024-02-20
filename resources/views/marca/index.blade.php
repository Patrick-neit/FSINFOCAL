@extends('layouts.page')

@section('title', 'Marcas')

@section('create-action-content')
<a href="#modalCrearMarca" id="crearMarca"
    class="btn waves-effect waves-light invoice-create border-round z-depth-4 modal-trigger">
    <i class="material-icons">add</i>
    <span class="hide-on-small-only">Crear Marca</span>
</a>
@endsection

@section('table-content')
<table aria-describedby="Marcas" class="table invoice-data-table white border-radius-4 pt-1">
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
        @foreach ($marcas as $marca)
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
                <a href="#modalEliminar" id="eliminar" class="btn btn-floating red modal-trigger"
                    data-id="{{ $marca->id }}" title="Eliminar Marca">
                    <i class="material-icons delete">delete</i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('additional-components')
@include('marca.modals.form')
@endsection

@section('page-custom-scripts')
<script>
    //For Table
    let numberColumns = 5;
    let searchString = 'Buscar Marca';
    //For Destroy
    let key_id ='marca_id';
    //For Edit
    let marca_id = null;
</script>
<script>
    let ruta_update_marca = "{{ route('marca.update', 'marca_id' ) }}";
    let ruta_guardar_marca = "{{ route('marca.store') }}";
    let ruta_index = "{{ route('marca.index') }}";
    let ruta_eliminar = "{{ route('marca.destroy') }}";
</script>
<script>
    let nombre_marca = document.getElementById("nombre_marca");
    let estado = document.getElementById("estado");
</script>
<script src="{{ asset('js/scripts/marca/submitForm.js') }}"></script>
<script src="{{ asset('js/scripts/marca/create.js') }}"></script>
<script src="{{ asset('js/scripts/marca/edit.js') }}"></script>
@endsection