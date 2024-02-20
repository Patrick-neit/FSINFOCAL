@extends('layouts.page')

@section('title', 'Pedidos')

@section('create-action-content')
<a href="{{ route('pedido.create') }}" class="btn waves-effect waves-light invoice-create border-round z-depth-4">
    <i class="material-icons">add</i>
    <span class="hide-on-small-only">Crear Pedido</span>
</a>
@endsection

@section('table-content')
<table aria-describedby="Pedidos" class="table invoice-data-table white border-radius-4 pt-1">
    <thead>
        <tr>
            <th></th>
            <th></th>
            <th>C&oacute;digo pedido</th>
            <th>Descripci&oacute;n</th>
            <th>Estado Aprobaci&oacute;n</th>
            <th>Total</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pedidos as $pedido)
        @if ($pedido->aprobado == 'Pendiente')
        <tr>
            <td></td>
            <td></td>
            <td>{{ $pedido->id }}</td>
            <td>{{ $pedido->nota }}</td>
            <td>{{ $pedido->aprobado }}</td>
            <td>{{ $pedido->total }}</td>
            <td>
                <a href="{{ route('pedido.edit', $pedido->id)}}" class="btn btn-floating orange modal-trigger"
                    data-pedido="{{ $pedido }}" title="Editar Pedido">
                    <i class="material-icons">edit</i>
                </a>
                <a href="#modalEliminar" id="eliminar" class="btn btn-floating red modal-trigger"
                    data-id="{{ $pedido->id }}" title="Eliminar Pedido">
                    <i class="material-icons delete">delete</i>
                </a>
            </td>
        </tr>
        @endif
        @endforeach
    </tbody>
</table>
@endsection

@section('page-custom-scripts')
<script>
    //For Table
    let numberColumns = 7;
    let searchString = 'Buscar Pedido';
    //For Destroy
    let key_id ='pedido_id';
</script>
<script>
    let ruta_index = "{{ route('pedido.index') }}";
    let ruta_eliminar = "{{ route('pedido.destroy') }}";
    let ruta_aprobar_pedido = "{{ route('compras.aprobar_pedido') }}";
</script>
@endsection