@extends('layouts.page')

@section('title', 'Productos')

@section('create-action-content')
<a href="{{ route('producto.create') }}"
    class="btn waves-effect waves-light invoice-create border-round z-depth-4 modal-trigger">
    <i class="material-icons">add</i>
    <span class="hide-on-small-only">Crear Producto</span>
</a>
@endsection

@section('table-content')
<table aria-describedby="productos" class="table invoice-data-table white border-radius-4 pt-1">
    <thead>
        <tr>
            <th></th>
            <th></th>
            <th>C&oacute;digo Producto</th>
            <th>Nombre producto</th>
            <th>Caracteristica</th>
            <th>Stock Actual</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($productos as $producto)
        <tr>
            <td></td>
            <td></td>
            <td>{{ $producto->codigo_producto }}</td>
            <td>{{ $producto->nombre_producto }}</td>
            <td>{{ empty($producto->caracteristicas) ? 'Ninguno': $producto->caracteristicas }}</td>
            <td>10</td>
            <td>{{ $producto->estado }}</td>
            <td>
                <a href="{{ route('producto.edit', $producto->id)}}" class="btn btn-floating orange modal-trigger"
                    title="Editar Producto">
                    <i class="material-icons">edit</i>
                </a>
                <a href="#modalEliminar" id="eliminar" class="btn btn-floating red modal-trigger"
                    data-id="{{ $producto->id }}" title="Eliminar Producto">
                    <i class="material-icons delete">delete</i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('page-custom-scripts')
<script>
    //For Table
    let numberColumns = 8;
    let searchString = 'Buscar Producto';
    //For Destroy
    let key_id ='producto_id';
</script>
<script>
    let ruta_index = "{{ route('producto.index') }}";
    let ruta_eliminar = "{{ route('producto.destroy') }}";
</script>
@endsection