@extends('layouts.page')

@section('title', 'Categorias')

@section('create-action-content')
<a href="#modalCrearCategoria" id="crearCategoria"
    class="btn waves-effect waves-light invoice-create border-round z-depth-4 modal-trigger">
    <i class="material-icons">add</i>
    <span class="hide-on-small-only">Crear Categoria</span>
</a>
@endsection

@section('table-content')
<table aria-describedby="Categorias" class="table invoice-data-table white border-radius-4 pt-1">
    <thead>
        <tr>
            <th></th>
            <th></th>
            <th>Nombre Categoria</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categorias as $categoria)
        <tr>
            <td></td>
            <td></td>
            <td>{{ $categoria->nombre_categoria }}</td>
            <td>
                @if ($categoria->estado)
                <span class="badge badge pill green">Activo</span>
                @else
                <span class="badge badge pill red">Inactivo</span>
                @endif
            </td>
            <td>
                <a href="#modalCrearCategoria" id="editarCategoria" class="btn btn-floating orange modal-trigger"
                    data-categoria="{{ $categoria }}" title="Editar Categoria">
                    <i class="material-icons">edit</i>
                </a>
                <a href="#modalEliminar" id="eliminar" class="btn btn-floating red modal-trigger"
                    data-id="{{ $categoria->id }}" title="Eliminar Categoria">
                    <i class="material-icons delete">delete</i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('additional-components')
@include('categoria.modals.form')
@endsection

@section('page-custom-scripts')
<script>
    //For Table
    let numberColumns = 5;
    let searchString = 'Buscar Categoria';
    //For Destroy
    let key_id ='categoria_id';
    //For Edit
    let categoria_id = null;
</script>
<script>
    let ruta_update_categoria = "{{ route('categoria.update') }}";
    let ruta_guardar_categoria = "{{ route('categoria.store') }}";
    let ruta_index = "{{ route('categoria.index') }}";
    let ruta_eliminar = "{{ route('categoria.destroy') }}";
</script>
<script>
    let nombre_categoria = document.getElementById("nombre_categoria");
    let estado = document.getElementById("estado");
</script>
<script src="{{ asset('js/scripts/categoria/submitForm.js') }}"></script>
<script src="{{ asset('js/scripts/categoria/create.js') }}"></script>
<script src="{{ asset('js/scripts/categoria/edit.js') }}"></script>
@endsection