@extends('layouts.contentLayoutMaster')

@section('title','Catalogos de Impuestos')

@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/data-tables/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css"
    href="{{ asset('vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css') }}">
@endsection

{{-- page styles --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{ asset('css/pages/page-users.css') }}">
<style>
    .tabs-fixed-width.grid-container {
        overflow-x: auto;
    }
    .tabs-fixed-width.grid-container::-webkit-scrollbar {
        height: 5px;
    }

    .tabs-fixed-width.grid-container::-webkit-scrollbar-thumb {
        background-color: #757575;
        border-radius: 2px;
    }
    .tabs-fixed-width.grid-container::-webkit-scrollbar-track {
        background-color: #f1f1f1;
        border-radius: 2px;
    }
</style>
@endsection

@section('content')
<section class="users-list-wrapper section">
    <div class="users-list-table">
        <div class="card panel">
            <div class="card-content">
                <ul class="tabs tabs-fixed-width tab-demo grid-container" id="tabs">
                    <li class="tab grid-item"><a class="active" href="#sincronizarFechaHora">Fecha y Hora</a></li>
                    <li class="tab grid-item"><a href="#sincronizarParametricaMotivoAnulacion">Motivos Anulaciones</a>
                    </li>
                    <li class="tab grid-item"><a href="#sincronizarParametricaTipoDocumentoSector">Tipos de
                            Documentos Sectores</a>
                    </li>
                    <li class="tab grid-item"><a href="#sincronizarListaActividadesDocumentoSector">Documentos
                            Sectores</a></li>
                    <li class="tab grid-item"><a href="#sincronizarParametricaTiposFactura">Tipos de Facturas</a></li>
                    <li class="tab grid-item"><a href="#sincronizarListaMensajesServicios">Mensajes de Servicios</a>
                    </li>
                    <li class="tab grid-item"><a href="#sincronizarParametricaEventosSignificativos">Eventos
                            Significativos</a>
                    </li>
                    <li class="tab grid-item"><a href="#sincronizarParametricaTipoPuntoVenta">Tipos de PV</a></li>
                    <li class="tab grid-item"><a href="#sincronizarListaProductosServicios">Productos y Servicios</a>
                    </li>
                    <li class="tab grid-item"><a href="#sincronizarParametricaTipoMoneda">Tipo de Moneda</a></li>
                    <li class="tab grid-item"><a href="#sincronizarActividades">Actividades</a></li>
                    <li class="tab grid-item"><a href="#sincronizarParametricaTipoEmision">Tipo de Emision</a></li>
                    <li class="tab grid-item"><a href="#sincronizarParametricaTipoDocumentoIdentidad">Tipo de Documento
                            de
                            Identidad</a></li>
                    <li class="tab grid-item"><a href="#sincronizarListaLeyendasFactura">Leyendas de Factura</a></li>
                    <li class="tab grid-item"><a href="#sincronizarParametricaTipoMetodoPago">Metodos de Pago</a></li>
                    <li class="tab grid-item"><a href="#sincronizarParametricaUnidadMedida">Unidades de Medida</a></li>
                    <li class="tab grid-item"><a href="#sincronizarParametricaPaisOrigen">Pais de Origen</a></li>
                    <li class="tab grid-item"><a href="#sincronizarParametricaTipoHabitacion">Tipos de Habitacion</a>
                    </li>
                </ul>
                <div id="sincronizarFechaHora" class="col s12 m12 l12 white">
                    <div class="row mb-1 mt-1">
                        @include('sincronizacion.fechahora')
                    </div>
                </div>
                <div id="sincronizarParametricaMotivoAnulacion" class="col s12 m12 l12 white">
                    <div class="row mb-1 mt-1">
                        @include('sincronizacion.motivoAnulacion')
                    </div>
                </div>
                <div id="sincronizarParametricaTipoDocumentoSector" class="col s12 m12 l12 white">
                    <div class="row mb-1 mt-1">
                        @include('sincronizacion.tipoDocumentoSector')
                    </div>
                </div>
                <div id="sincronizarListaActividadesDocumentoSector" class="col s12 m12 l12 white">
                    <div class="row mb-1 mt-1">
                        @include('sincronizacion.documentoSector')
                    </div>
                </div>
                <div id="sincronizarParametricaTiposFactura" class="col s12 m12 l12 white">
                    <div class="row mb-1 mt-1">
                        @include('sincronizacion.tiposFactura')
                    </div>
                </div>
                <div id="sincronizarListaMensajesServicios" class="col s12 m12 l12 white">
                    <div class="row mb-1 mt-1">
                        @include('sincronizacion.mensajesServicios')
                    </div>
                </div>
                <div id="sincronizarParametricaEventosSignificativos" class="col s12 m12 l12 white">
                    <div class="row mb-1 mt-1">
                        @include('sincronizacion.eventosSignificativos')
                    </div>
                </div>
                <div id="sincronizarParametricaTipoPuntoVenta" class="col s12 m12 l12 white">
                    <div class="row mb-1 mt-1">
                        @include('sincronizacion.tipoPV')
                    </div>
                </div>
                <div id="sincronizarListaProductosServicios" class="col s12 m12 l12 white">
                    <div class="row mb-1 mt-1">
                        @include('sincronizacion.productosServicios')
                    </div>
                </div>
                <div id="sincronizarParametricaTipoMoneda" class="col s12 m12 l12 white">
                    <div class="row mb-1 mt-1">
                        @include('sincronizacion.tipoMoneda')
                    </div>
                </div>
                <div id="sincronizarActividades" class="col s12 m12 l12 white">
                    <div class="row mb-1 mt-1">
                        @include('sincronizacion.listadoActividades')
                    </div>
                </div>
                <div id="sincronizarParametricaTipoEmision" class="col s12 m12 l12 white">
                    <div class="row mb-1 mt-1">
                        @include('sincronizacion.tipoEmision')
                    </div>
                </div>
                <div id="sincronizarParametricaTipoDocumentoIdentidad" class="col s12 m12 l12 white">
                    <div class="row mb-1 mt-1">
                        @include('sincronizacion.tipodocumentoidentidad')
                    </div>
                </div>
                <div id="sincronizarListaLeyendasFactura" class="col s12 m12 l12 white">
                    <div class="row mb-1 mt-1">
                        @include('sincronizacion.leyendasFacturas')
                    </div>
                </div>
                <div id="sincronizarParametricaTipoMetodoPago" class="col s12 m12 l12 white">
                    <div class="row mb-1 mt-1">
                        @include('sincronizacion.metodosPagos')
                    </div>
                </div>
                <div id="sincronizarParametricaUnidadMedida" class="col s12 m12 l12 white">
                    <div class="row mb-1 mt-1">
                        @include('sincronizacion.unidadMedida')
                    </div>
                </div>
                <div id="sincronizarParametricaPaisOrigen" class="col s12 m12 l12 white">
                    <div class="row mb-1 mt-1">
                        @include('sincronizacion.paisOrigen')
                    </div>
                </div>
                <div id="sincronizarParametricaTipoHabitacion" class="col s12 m12 l12 white">
                    <div class="row mb-1 mt-1">
                        @include('sincronizacion.tipoHabitacion')
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('vendor-script')
<script src="{{ asset('vendors/data-tables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js') }}"></script>
@endsection

{{-- page script --}}
@section('page-script')
<script src="{{ asset('js/scripts/sincronizacion/sincronizar.js') }}"></script>
<!-- Tu script jQuery -->
<script>
    let ruta_sinc_sincronizar = "{{ route('sincronizar', 'accion') }}";
</script>
@endsection