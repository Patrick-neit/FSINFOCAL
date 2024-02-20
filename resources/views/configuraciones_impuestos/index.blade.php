@extends('layouts.page')

@section('title', 'Configuraciones Impuestos')

@section('create-action-content')
<a href="#modalCrearConfiguracionImpuesto" id="crearConfiguracionImpuesto"
    class="btn waves-effect waves-light invoice-create border-round z-depth-4 modal-trigger">
    <i class="material-icons">add</i>
    <span class="hide-on-small-only">Crear Configuracion Impuesto</span>
</a>
@endsection

@section('table-content')
<table aria-describedby="configuracion_impuesto" class="table invoice-data-table white border-radius-4 pt-1">
    <thead>
        <tr>
            <th></th>
            <th></th>
            <th>Id</th>
            <th>Nombre Sistema</th>
            <th>Ambiente</th>
            <th>Modalidad</th>
            <th>Codigo Sistema</th>
            <th>Empresa Asociada</th>
            <th>Accion</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($taxesConfigurations as $taxConfiguration)
        <tr>
            <td></td>
            <td></td>
            <td>{{ $taxConfiguration->id }}</td>
            <td>{{ $taxConfiguration->nombre_sistema }}</td>
            @if ($taxConfiguration->ambiente == 1)
            <td><span class="chip lighten-5 green green-text">Produccion</span></td>
            @else
            <td><span class="chip lighten-5 red red-text">Pruebas</span></td>
            @endif
            @if ($taxConfiguration->modalidad == 1)
            <td><span class="green-text">Electr&oacute;nica en Linea</span>
            </td>
            @else
            <td><span class="red-text">Computarizada en Línea</span></td>
            @endif
            <td>{{ $taxConfiguration->codigo_sistema }}</td>
            <td> <span class="green-text">{{ $taxConfiguration->empresa->nombre_empresa }}</span>
                </span> </td>
            <td>
                <a href="#modalCrearConfiguracionImpuesto" id="editarConfiguracionImpuesto"
                    class="btn btn-floating orange modal-trigger" data-configuracion_impuesto="{{ $taxConfiguration }}"
                    title="Editar Configuracion Impuesto">
                    <i class="material-icons">edit</i>
                </a>
                <a href="#modalEliminar" id="eliminar" class="btn btn-floating red modal-trigger"
                    data-id="{{ $taxConfiguration->id }}" title="Eliminar Configuracion Impuesto">
                    <i class="material-icons delete">delete</i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('additional-components')
@include('configuraciones_impuestos.modals.form')
@endsection

@section('page-custom-scripts')
<script>
    //For Table
    let numberColumns = 9;
    let searchString = 'Buscar Configuracion';
    //For Destroy
    let key_id ='configuracion_impuesto_id';
    //For Edit
    let configuracion_impuesto_id = null;
</script>
<script>
    let ruta_guardar_configuracion_impuesto = "{{ route('configuraciones_impuestos.store') }}"
    let ruta_update_configuracion_impuesto = "{{ route('configuraciones_impuestos.update','configuracion_impuesto_id') }}"
    let ruta_index = "{{ route('configuraciones_impuestos.index') }}";
    let ruta_eliminar = "{{ route('configuraciones_impuestos.destroy') }}"
</script>
<script>
    let nombre_sistema = document.getElementById("nombre_sistema");
    let codigo_sistema = document.getElementById("codigo_sistema");
    let modalidad = document.getElementById("modalidad");
    let ambiente = document.getElementById("ambiente");
    let empresa_id = document.getElementById("empresa_id");
    let estado = document.getElementById("estado");
    let token_sistema = document.getElementById("token_sistema");
</script>
<script src="{{ asset('js/scripts/configuraciones_impuestos/submitForm.js') }}"></script>
<script src="{{ asset('js/scripts/configuraciones_impuestos/create.js') }}"></script>
<script src="{{ asset('js/scripts/configuraciones_impuestos/edit.js') }}"></script>
@endsection