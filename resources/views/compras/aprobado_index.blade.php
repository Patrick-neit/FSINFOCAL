{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Nueva marca')

{{-- vendor styles --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2-materialize.css')}}">
@endsection

{{-- page style --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/page-users.css')}}">
@endsection

{{-- page content --}}
@section('content')
<!-- users edit start -->
<div class="section users-edit">
    <div class="card">
        <div class="card-content">
            <!-- <div class="card-body"> -->
            <ul class="tabs mb-2 row">
                <li class="tab">
                    <a class="display-flex align-items-center active" id="account-tab" href="#account">
                        <i class="material-icons mr-1">person_outline</i><span>Gestión Aprobacion Pedido</span>
                    </a>
                </li>
            </ul>
            <div class="divider mb-3"></div>
            @csrf
            <div class="row">
                <div class="col s12 m3 l3 input-field">
                    <select class="select2 browser-default" name="tipo_documento_id" id="tipo_documento_id">
                        @forelse (\App\Enums\TipoDocumento::cases() as $case)
                        <option value="{{ $case->value }}">{{ $case->name }}</option>
                        @empty
                        <option value="">No hay opciones</option>
                        @endforelse
                    </select>
                </div>
                <div class="col s12 m3 l3 input-field">
                    <input id="numero_documento" name="numero_documento" type="text" class="validate"
                        value="@if (isset($cabecera_producto)){{ $cabecera_producto->codigo_producto }}@else{{old('numero_documento')}}@endif"
                        data-error=".errorTxt1" required>
                    <label for="numero_documento">N&uacute;mero de Documento</label>
                    <small class="errorTxt1"></small>
                </div>
                <div class="col s12 m3 l3 input-field">
                    <select class="select2 browser-default" name="metodo_pago_id" id="metodo_pago_id">
                        @forelse ($metodos_pagos as $metodo)
                        <option value="{{ $metodo->codigo_clasificador }}">{{ $metodo->descripcion }}</option>
                        @empty
                        <option value="">No hay opciones</option>
                        @endforelse
                    </select>
                </div>
                <div class="col s12 m3 l3 input-field">
                    <input id="lote" name="lote" type="text" class="validate"
                        value="@if (isset($cabecera_producto)){{ $cabecera_producto->codigo_producto }}@else{{old('numero_documento')}}@endif"
                        data-error=".errorTxt1" required>
                    <label for="lote">Lote</label>
                    <small class="errorTxt1"></small>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m8 l4 input-field">
                    <select class="select2 browser-default" name="proveedor_id" id="proveedor_id" disabled>
                        <option selected value="" disabled>Seleccione proveedor</option>
                        @forelse ($proveedores as $proveedor)
                        <option value="{{ $proveedor->id }}" @if (isset($pedido)) @if($pedido->proveedor_id ==
                            $proveedor->id)
                            selected
                            @endif
                            @endif
                            >{{ $proveedor->nombre_proveedor }}</option>
                        @empty
                        <option value="">No hay opciones</option>
                        @endforelse
                    </select>
                </div>
                <div class="input-field col s12 m4 offset-l4">
                    <i class="material-icons prefix">date_range</i>
                    <input id="fecha_pedido" name="fecha_pedido" type="text" class="datepicker" value="@if (isset($pedido))
                            {{ $pedido->fecha }}
                        @endif" disabled>
                    <label for="fecha_pedido">Fecha Pedido</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m4 offset-m8 l4 offset-l8">
                    <i class="material-icons prefix">date_range</i>
                    <input id="hora_pedido" name="hora_pedido" type="text" class="timepicker"
                        value="@if(isset($pedido)){{ $pedido->hora }}@endif" disabled>
                    <label for="hora_pedido">Hora Pedido</label>
                </div>
            </div>
            <div class="row">
                <table id="tableDetalleProducto" class="striped centered">
                    <thead>
                        <tr>
                            <th>C&oacute;digo Producto</th>
                            <th>Producto</th>
                            <th>Unidad Medida</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Subtotal</th>
                            <th>Fecha Vencimiento</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if (isset($pedido))
                        @forelse ($detalle_pedido as $item)
                        <tr id="{{ $loop->index }}">
                            <td>{{ $item->producto->codigo_producto }}</td>
                            <input type="hidden" name="productos[]" class="producto-checkbox" value="{{$item->id}}" />
                            <td>{{ $item->producto->nombre_producto }}</td>
                            <td>{{
                                \App\Models\ImpuestoUnidadMedida::where('codigo_clasificador',
                                $item->producto->unidad_medida_id)->first()->descripcion
                                }}</td>
                            <td><input id="inputCantidad{{ $item->id }}" name="{{ $item->id }}"
                                    value="{{ $item->cantidad }}" type="number" min="0.00001" step="0.00001" disabled>
                            </td>
                            <td>
                                <input id="inputPrecioUnitario{{ $item->id }}" name="{{ $item->id }}"
                                    value="{{ number_format($item->precio_unitario, 5, '.', '') }}" type="number"
                                    min="0.00001" step="0.00001" disabled>
                            </td>
                            <td>
                                <span id="subtotal{{ $item->id }}" name="{{ $item->id }}">
                                    {{ number_format($item->sub_total, 5, '.', '') }}
                                </span>
                            </td>
                            <td>
                                <input id="fecha_v_{{ $item->id }}" name="fecha_v_{{ $item->id }}" type="text"
                                    class="datepicker">
                            </td>
                            {{-- <td>
                                <a id="{{ $item->id }}" name="{{ $item->id }}" class="waves-effect waves-light btn"
                                    onclick="cambiarTabla(this.name)">
                                    <i class='material-icons prefix'>delete</i>
                                </a>
                            </td> --}}
                        </tr>
                        @empty
                        @endforelse
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col s12 m8 l8 input-field">
                    <textarea id="nota" name="nota" class="materialize-textarea" disabled>@if(isset($pedido)){{
                        $pedido->nota
                        }}@endif</textarea>
                    <label for="textarea1">Nota/Descripci&oacute;n</label>
                </div>
                <div class="col s12 m2 l2 input-field">
                    <h6>Total:</h6>
                    <h6>Tipo Cambio:</h6>
                    <h6>Total Dolar:</h6>
                </div>
                <div class="col s12 m2 l2 input-field right-align">
                    <h6 id="subTotal">Bs.&nbsp;
                        @if (isset($pedido))
                        {{ $pedido->total }}
                        @else
                        {{
                        number_format((float)\LukePOLO\LaraCart\Facades\LaraCart::subTotal(false),
                        5, '.',
                        '') }}
                        @endif
                    </h6>
                    <h6>6.96</h6>
                    <h6 id="totalDolar">Bs.&nbsp;
                        @if (isset($pedido))
                        {{ number_format((float)$pedido->total * 6.96, 5, '.', '') }}
                        @else
                        {{
                        number_format((float)(\LukePOLO\LaraCart\Facades\LaraCart::subTotal(false)) * 6.96, 5, '.', '')
                        }}
                        @endif
                    </h6>
                </div>

            </div>
            <div class="row">
                <input type="hidden" id="id_pedido" name="id_pedido" value="@if(isset($pedido)){{ $pedido->id }}@endif">

                <div class="col s12 display-flex justify-content-end mt-3">
                    <button id="registrarAprobacionButton" class="btn indigo mr-2">Guardar</button>
                    <button type="button" class="btn btn-light">Cancel</button>
                </div>
            </div>
            <!-- </div> -->
        </div>
    </div>
</div>
<!-- users edit ends -->
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
<script src="{{asset('vendors/select2/select2.full.min.js')}}"></script>
<script src="{{asset('vendors/jquery-validation/jquery.validate.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-script')
<script src="{{asset('js/scripts/compras/pedido_aprobado.js')}}"></script>
<script>
    let ruta_aprobar_pedido = "{{route('compras.aprobar_pedido')}}";
    let ruta_pedidos_index = "{{ route('pedido.index') }}";
</script>
@endsection