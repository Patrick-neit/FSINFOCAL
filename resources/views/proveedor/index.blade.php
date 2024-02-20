@extends('layouts.page')

@section('title', 'Proveedores')

@section('create-action-content')
<a href="#modalCrearProveedor" id="crearProveedor"
    class="btn waves-effect waves-light invoice-create border-round z-depth-4 modal-trigger">
    <i class="material-icons">add</i>
    <span class="hide-on-small-only">Crear Proveedor</span>
</a>
@endsection

@section('table-content')
<table aria-describedby="Proveedores" class="table invoice-data-table white border-radius-4 pt-1">
    <thead>
        <tr>
            <th></th>
            <th></th>
            <th>Proveedor</th>
            <th>Tel&eacute;fono</th>
            <th>Rubro</th>
            <th>Nro. Documento</th>
            <th>Correo</th>
            <th>Sucursal</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($proveedores as $proveedor)
        <tr>
            <td></td>
            <td></td>
            <td>{{ $proveedor->nombre_proveedor }}</td>
            <td>{{ $proveedor->telefono }}</td>
            <td>{{ $proveedor->rubro }}</td>
            <td>{{ $proveedor->numero_nit }}</td>
            <td>{{ $proveedor->correo }}</td>
            <td>{{ $proveedor->sucursal->nombre_sucursal }}</td>
            <td>{{ $proveedor->estado }}</td>
            <td>
                <a href="#modalCrearProveedor" id="editarProveedor" class="btn btn-floating orange modal-trigger"
                    data-proveedor="{{ $proveedor }}" title="Editar Proveedor">
                    <i class="material-icons">edit</i>
                </a>
                <a href="#modalEliminar" id="eliminar" class="btn btn-floating red modal-trigger"
                    data-id="{{ $proveedor->id }}" title="Eliminar Proveedor">
                    <i class="material-icons delete">delete</i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('additional-components')
@include('proveedor.modals.form')
@endsection

@section('page-custom-scripts')
<script>
    //For Table
    let numberColumns = 10;
    let searchString = 'Buscar Proveedor';
    //For Destroy
    let key_id ='proveedor_id';
    //For Edit
    let proveedor_id = null;
</script>
<script>
    let ruta_guardar_proveedor = "{{ route('proveedor.store') }}";
    let ruta_update_proveedor = "{{ route('proveedor.update') }}";
    let ruta_index = "{{ route('proveedor.index') }}";
    let ruta_eliminar = "{{ route('proveedor.destroy') }}";
</script>
<script>
    let nombre_proveedor = document.getElementById("nombre_proveedor");
    let direccion = document.getElementById("direccion");
    let telefono = document.getElementById("telefono");
    let rubro = document.getElementById("rubro");
    let documentoIdentidad = document.getElementById("documentoIdentidad");
    let numero_documento = document.getElementById("numero_documento");
    let correo = document.getElementById("correo");
    let contacto = document.getElementById("contacto");
    let estado = document.getElementById("estado");
    let sucursal_id = document.getElementById("sucursal_id");
</script>
<script src="{{ asset('js/scripts/proveedor/submitForm.js') }}"></script>
<script src="{{ asset('js/scripts/proveedor/create.js') }}"></script>
<script src="{{ asset('js/scripts/proveedor/edit.js') }}"></script>
@endsection