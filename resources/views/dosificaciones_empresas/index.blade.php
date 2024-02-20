@extends('layouts.page')

@section('title', 'Dosificaciones')

@section('create-action-content')
<a href="#modalCrearDosificacion" id="crearDosificacion"
    class="btn waves-effect waves-light invoice-create border-round z-depth-4 modal-trigger">
    <i class="material-icons">add</i>
    <span class="hide-on-small-only">Crear Dosificacion</span>
</a>
@endsection

@section('table-content')
<table aria-describedby="dosificacion" class="table invoice-data-table white border-radius-4 pt-1">
    <thead>
        <tr>
            <th></th>
            <th></th>
            <th>Fecha Asignacion</th>
            <th>Nombre Empresa</th>
            <th>Cafc Empresa</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dosificacionesEmpresas as $dosificacion)

        <tr>
            <td></td>
            <td></td>
            <td>{{ $dosificacion->fecha_asignacion }}</td>
            <td><a>{{ $dosificacion->empresa->nombre_empresa }}</a></td>
            <td>{{ $dosificacion->cafc }}</td>
            <td>
                <a href="#modalCrearDosificacion" id="editarDosificacion" class="btn btn-floating orange modal-trigger"
                    data-dosificacion="{{ $dosificacion }}" title="Editar Dosificacion">
                    <i class="material-icons">edit</i>
                </a>
                <a href="#modalEliminar" id="eliminar" class="btn btn-floating red modal-trigger"
                    data-id="{{ $dosificacion->id }}" title="Eliminar Dosificacion">
                    <i class="material-icons delete">delete</i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('additional-components')
@include('dosificaciones_empresas.modals.form')
@endsection

@section('page-custom-scripts')
<script>
    //For Table
    let numberColumns = 6;
    let searchString = 'Buscar Dosificacion';
    //For Destroy
    let key_id ='dosificacion_id';
    //For Edit
    let dosificacion_id = null;
</script>
<script>
    let ruta_index = "{{ route('dosificaciones_empresas.index') }}";
    let ruta_eliminar = ""
    let ruta_eliminar_detalle_dosificacion = "{{ route('dosificaciones_empresas.eliminarDetalle') }}";
    let ruta_dosificacion_empresa = "{{ route('dosificaciones_empresas.getDataDocumentoSector') }}";
    let ruta_index_dosificacion = "{{ route('dosificaciones_empresas.index') }}";
    let ruta_store_dosificacion = "{{ route('dosificaciones_empresas.store') }}";
</script>
<script>
    let empresa_id = document.getElementById('empresa_id');
    let empresa_cafc = document.getElementById('empresa_cafc');
    let nro_inicio_factura = document.getElementById('nro_inicio_factura');
    let nro_fin_factura = document.getElementById('nro_fin_factura'); 
</script>
<script>
    $(".select2").select2({
        dropdownParent: $('#modalCrearDosificacion .modal-content'),
        dropdownAutoWidth: true,
        width: '100%',
    });
</script>
<script src="{{ asset('js/scripts/dosificaciones_empresas/submitForm.js') }}"></script>
<script src="{{ asset('js/scripts/dosificaciones_empresas/create.js') }}"></script>
<script src="{{ asset('js/scripts/dosificaciones_empresas/edit.js') }}"></script>
@endsection