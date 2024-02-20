@extends('layouts.page')

@section('title', 'Puntos de Ventas')

@section('create-action-content')
<a href="#modalCrearPuntoVenta" id="crearPuntoVenta"
    class="btn waves-effect waves-light invoice-create border-round z-depth-4 modal-trigger">
    <i class="material-icons">add</i>
    <span class="hide-on-small-only">Crear Punto de Venta</span>
</a>
@endsection

@section('table-content')
<table aria-describedby="puntos_ventas" class="table invoice-data-table white border-radius-4 pt-1">
    <thead>
        <tr>
            <th></th>
            <th></th>
            <th>Nombre Punto Venta</th>
            <th>Tipo Punto Venta</th>
            <th>Codigo Punto Venta</th>
            <th>Sucursal Asociada</th>
            <th>Empresa Asociada</th>
            <th>Descripcion Punto Venta</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($puntosVentas as $puntoVenta)
        <tr>
            <td></td>
            <td></td>
            <td>{{ $puntoVenta->nombre_punto_venta }}</td>
            <td>{{ $puntoVenta->tipo_punto_venta }}</td>
            <td> <span class="green-text"> {{ $puntoVenta->codigo_punto_venta }}</span> </td>
            <td> <span class="red-text">{{$puntoVenta->sucursal->nombre_sucursal}}</span> </td>
            <td> <span class="red-text">{{$puntoVenta->empresa->nombre_empresa}}</span> </td>
            <td> {{ $puntoVenta->descripcion_punto_venta }} </td>
            <td>
                <a href="#modalCrearPuntoVenta" id="editarPuntoVenta" class="btn btn-floating orange modal-trigger"
                    data-punto_venta="{{ $puntoVenta }}" title="Editar PuntoVenta">
                    <i class="material-icons">edit</i>
                </a>
                <a href="#modalEliminar" id="eliminar" class="btn btn-floating red modal-trigger"
                    data-id="{{ $puntoVenta->id }}" title="Eliminar PuntoVenta">
                    <i class="material-icons delete">delete</i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('additional-components')
@include('puntos_ventas.modals.form')
@endsection

@section('page-custom-scripts')
<script>
    //For Table
    let numberColumns = 9;
    let searchString = 'Buscar Punto de Venta';
    //For Destroy
    let key_id ='punto_venta_id';
    //For Edit
    let punto_venta_id = null;
</script>
<script>
    let ruta_guardar_punto_venta = "{{ route('puntos_ventas.store') }}"
    let ruta_update_punto_venta = ""
    let ruta_index = "{{ route('puntos_ventas.index') }}";
    let ruta_eliminar = "";
</script>
<script>
    let nombre_punto_venta = document.getElementById("nombre_punto_venta");
    let descripcion_punto_venta = document.getElementById("descripcion_punto_venta");
    let tipo_punto_venta = document.getElementById("tipo_punto_venta");
    let sucursal_id = document.getElementById("sucursal_id");
</script>
<script src="{{ asset('js/scripts/puntos_ventas/submitForm.js') }}"></script>
<script src="{{ asset('js/scripts/puntos_ventas/create.js') }}"></script>
<script src="{{ asset('js/scripts/puntos_ventas/edit.js') }}"></script>
@endsection