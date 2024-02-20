@extends('layouts.page')

@section('title', 'Clientes')

@section('create-action-content')
<a href="#modalCrearCliente" id="crearCliente"
    class="btn waves-effect waves-light invoice-create border-round z-depth-4 modal-trigger">
    <i class="material-icons">add</i>
    <span class="hide-on-small-only">Crear Cliente</span>
</a>
@endsection

@section('table-content')
<table aria-describedby="Clientes" class="table invoice-data-table white border-radius-4 pt-1">
    <thead>
        <tr>
            <th></th>
            <th></th>
            <th>Nombre cliente</th>
            <th>Documento</th>
            <th>N. Documento</th>
            <th>Complemento</th>
            <th>Telefono</th>
            <th>Correo</th>
            <th>Contacto</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($clientes as $cliente)
        <tr>
            <td></td>
            <td></td>
            <td>{{ $cliente->nombre_cliente }}</td>
            <td>{{ $cliente->impuestos_documentos_identidad->descripcion }}</td>
            <td>{{ $cliente->numero_nit }}</td>
            <td>{{ $cliente->complemento }}</td>
            <td>{{ $cliente->telefono }}</td>
            <td>{{ $cliente->correo }}</td>
            <td>{{ $cliente->contacto }}</td>
            <td>{{ $cliente->estado }}</td>
            <td>
                <a href="#modalCrearCliente" id="editarCliente" class="btn btn-floating orange modal-trigger"
                    data-cliente="{{ $cliente }}" title="Editar Cliente">
                    <i class="material-icons">edit</i>
                </a>
                <a href="#modalEliminar" id="eliminar" class="btn btn-floating red modal-trigger"
                    data-id="{{ $cliente->id }}" title="Eliminar Cliente">
                    <i class="material-icons delete">delete</i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('additional-components')
@include('cliente.modals.form')
@endsection

@section('page-custom-scripts')
<script>
    //For Table
    let numberColumns = 11;
    let searchString = 'Buscar Cliente';
    //For Destroy
    let key_id ='cliente_id';
    //For Edit
    let cliente_id = null;
</script>
<script>
    let ruta_guardar_cliente = "{{ route('cliente.store') }}";
    let ruta_update_cliente = "{{ route('cliente.update') }}";
    let ruta_index = "{{ route('cliente.index') }}";
    let ruta_eliminar = "{{ route('cliente.destroy') }}";
</script>
<script>
    let registrarClienteButton = document.getElementById("registrarCliente");
    let nombre_cliente = document.getElementById("nombre_cliente");
    let documento = document.getElementById("documento");
    let numero_nit = document.getElementById("numero_nit");
    let complemento = document.getElementById("complemento");
    let direccion = document.getElementById("direccion");
    let telefono = document.getElementById("telefono");
    let correo = document.getElementById("correo");
    let departamento_id = document.getElementById("departamento_id");
    let fecha_cumpleanos = document.getElementById("fecha_cumpleanos");
    let contacto = document.getElementById("contacto");
    let tipos_precios = document.getElementById("tipos_precios");
    let estado = document.getElementById("estado");
</script>
<script src="{{ asset('js/scripts/cliente/submitForm.js') }}"></script>
<script src="{{ asset('js/scripts/cliente/create.js') }}"></script>
<script src="{{ asset('js/scripts/cliente/edit.js') }}"></script>
@endsection