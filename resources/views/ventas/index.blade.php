{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Gestion de Ventas')

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
                        <i class="material-icons mr-1">add_shopping_cart</i><span>Ventas</span>
                    </a>
                </li>
            </ul>
            <div class="divider mb-3"></div>
            @csrfs
            <div class="row">
                <div class="col s12 m8 l6 input-field">
                    <select class="select2 browser-default" name="cliente_id" id="cliente_id" onchange="getDataCliente()">
                        <option selected value="x">Seleccione Cliente</option>
                        @forelse ($clientes as $cliente)
                        <option value="{{ $cliente->id }}">
                            {{ $cliente->nombre_cliente }}</option>
                        @empty
                        <option value="">No hay opciones</option>
                        @endforelse
                    </select>
                    <a class="waves-effect waves-light btn disabled" id="nit_cliente_visual">NIT: 12470538</a>
                    <a class="waves-effect waves-light btn disabled" id="correo_cliente_visual" >Correo: patricio@rda-consult.com</a>
                </div>
                <div class="col s12 m8 l3 input-field">
                    <select class="select2 browser-default" name="tipo_moneda" id="tipo_moneda_id">
                        <option selected value="" disabled>Seleccione Moneda</option>
                        @forelse ($tipo_moneda as $moneda)
                        <option value="{{ $moneda->codigo_clasificador }}">
                            {{ $moneda->descripcion }}</option>
                        @empty
                        <option value="">No hay opciones</option>
                        @endforelse
                    </select>
                </div>
                <div class="col s12 m8 l3 input-field">
                    <select class="select2 browser-default" name="tipo_pago" id="tipo_pago_id" onchange="getTipoPagoInputs(this)">
                        <option selected value="" disabled>Seleccione Tipo Pago</option>
                        @forelse ($tipo_pago as $pago)
                        <option value="{{ $pago->codigo_clasificador }}">
                            {{ $pago->descripcion }}</option>
                        @empty
                        <option value="">No hay opciones</option>
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="row">
                <div id="numero-tarjeta-input">
                    <div class="input-field col s12 m2 offset-m8 l2">
                        <h6>Numero de tarjeta:</h6>
                    </div>
                    <div class="input-field col s12 m2 offset-m8 l1">
                        <input name="tarjeta_numero_1" type="number">
                    </div>
                    <div class="input-field col s12 m2 offset-m8 l1">
                        <input name="tarjeta_numero_2" type="number">
                    </div>
                    <div class="input-field col s12 m2 offset-m8 l1">
                        <input name="tarjeta_numero_3" type="number">
                    </div>
                    <div class="input-field col s12 m2 offset-m8 l1">
                        <input name="tarjeta_numero_4" type="number">
                    </div>
                </div>

                <div class="input-field col s12 m4 offset-m8 l4 offset-l2">
                    <select class="select2 browser-default" name="search_pedido" id="search_pedido"
                        onchange="cargarProducto()">
                        <option selected value="" disabled>Buscar Producto</option>
                        @forelse ($cabecera_productos as $cabecera_proveedor)
                        <option value="{{ $cabecera_proveedor->id }}">{{ $cabecera_proveedor->nombre_producto }}
                        </option>
                        @empty
                        <option value="">No hay opciones</option>
                        @endforelse
                    </select>
                </div>
            </div>
            {{-- <div id="modal1" class="modal modal-fixed-footer">
                <div class="modal-content">
                    <h4>Modal Header</h4>
                    <p>A bunch of text</p>
                </div>
                <div class="modal-footer">
                    <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
                    <a class="waves-effect waves-green btn-flat" onclick="cambiarTabla()">Agree</a>
                </div>
            </div> --}}
            <div class="row">
                <table id="tableDetalleProducto" class="striped centered">
                    <thead>
                        <tr>
                            <th>C&oacute;digo Producto</th>
                            <th>Producto</th>
                            <th>Unidad Medida</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Descuento X item</th>
                            <th>Subtotal</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if (isset($pedido))
                        //aqui es donde se lista los producto de detalle
                        @forelse (\LukePOLO\LaraCart\Facades\LaraCart::getItems() as $item)
                        <tr id="{{ $item->id }}">
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->unidad_medida_literal }}</td>
                            <td><input id="inputCantidad{{ $item->id }}" name="{{ $item->id }}" value="{{ $item->qty }}"
                                    type="number" min="0.00001" step="0.00001" onchange="calcularSubTotal(this.name);">
                            </td>
                            <td>
                                <input id="inputPrecioUnitario{{ $item->id }}" name="{{ $item->id }}"
                                    value="{{ number_format($item->price, 5, '.', '') }}" type="number" min="0.00001"
                                    step="0.00001" onchange='calcularSubTotal(this.name)'>
                            </td>

                            <td><input id="inputDescuento{{ $item->id }}" name="{{ $item->id }}" value="{{ $item->desc }}"
                                type="number" min="0.00000" step="0.00001" onchange="calcularSubTotal(this.name);">
                            </td>
                            <td>
                                <span id="subtotal{{ $item->id }}" name="{{ $item->id }}">
                                    {{ number_format($item->subtotal, 5, '.', '') }}
                                </span>
                            </td>
                            <td>
                                <a id="{{ $item->id }}" name="{{ $item->id }}" class="waves-effect waves-light btn"
                                    onclick="cambiarTabla(this.name)">
                                    <i class='material-icons prefix'>delete</i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        @endforelse
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col s12 m8 l8 input-field">
                    <textarea id="nota" name="nota" class="materialize-textarea">@if(isset($pedido)){{ $pedido->nota
                        }}@endif</textarea>
                    <label for="textarea1">Nota/Descripci&oacute;n</label>
                </div>
                <div class="col s12 m2 l2 input-field">
                    <h6>Importe Total:</h6>
                    <h6>Total D. Adicional:</h6>
                    <br>
                    <h6>SubTotal:</h6>
                    <br>
                    <h6 id="monto-giftcard-name">GiftCard:</h6>
                    <h6>Total:</h6>
                    <h6>Tipo Cambio:</h6>
                    <h6>Total Dolar:</h6>
                </div>
                <div class="col s12 m2 l2 input-field right-align">
                    <h6 id="importeTotal">187.5 Bs.</h6>
                    <input name="descuento_adicional" id="descuento_adicional" type="number" min="0.00001"
                        step="0.00001">
                    <h6 id="subTotalVerdadero">187.5 Bs.</h6>
                    <div id="monto-giftcard-input">
                        <input name="monto_giftcard" id="monto_giftcard" type="number" min="0.00001" step="0.00001">
                    </div>
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
                    <button id="registrarPedidoButton" class="btn indigo mr-2">Guardar</button>
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
<script src="{{asset('js/scripts/ventas/index.js')}}"></script>
<script>
    let ruta_obtener_cliente = "{{route('ventas.getDataCliente')}}";
  /*   let ruta_guardar_pedido = "{{route('pedido.store')}}";
    let ruta_index_pedido   = "{{route('pedido.index')}}";
    let rutal_all_cart = "{{ route('get.all.cart') }}";
    let ruta_eliminar_marca = "{{route('marca.destroy')}}";*/
    let ruta_obtener_producto = "{{route('producto.get.name')}}";
    /* let ruta_actualizar_cart = "{{ route('update.product.cart') }}" */
</script>
@endsection
