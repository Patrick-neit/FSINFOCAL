{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title', $breadcrumbs[2]['name'])

{{-- vendor styles --}}
@section('vendor-style')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/select2/select2-materialize.css') }}">
@endsection

{{-- page style --}}
@section('page-style')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pages/page-users.css') }}">
@endsection

{{-- page content --}}
@section('content')
    <!-- users edit start -->
    <div class="section users-edit">
        <div class="card">
            <form id="formVenta">
                <div class="card-content">
                    <h4 class="card-title">Datos Generales</h4>
                    <div class="divider mb-1 mt-1"></div>
                    <div class="row">
                        <div class="col s12 m8 l6 input-field">
                            <select class="select2 browser-default" name="cliente_id" id="cliente_id"
                                onchange="getDataCliente()">
                                <option selected value="x">Seleccione Cliente</option>
                                @forelse ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">
                                        {{ $cliente->nombre_cliente }}</option>
                                @empty
                                    <option value="">No hay opciones</option>
                                @endforelse
                            </select>
                            <div id="showClienteInfo">
                                <div class="chip">
                                    &nbsp;<span id="nit_cliente_visual"></span>
                                </div>
                                <div class="chip">
                                    &nbsp;<spn id="correo_cliente_visual"></spn>
                                </div>
                            </div>
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
                            <select class="select2 browser-default" name="tipo_pago" id="tipo_pago_id"
                                onchange="getTipoPagoInputs(this)">
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
                    <br>
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
                                    <option value="{{ $cabecera_proveedor->id }}">
                                        {{ $cabecera_proveedor->nombre_producto }}
                                    </option>
                                @empty
                                    <option value="">No hay opciones</option>
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <h4 class="card-title">Detalle de la venta</h4>
                    <div class="divider mb-1 mt-1"></div>
                    @include('common.preloader')
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <table aria-describedby="detalle_ventas" id="tableDetalleProducto" class="responsive-table">
                                <thead>
                                    <tr>
                                        <th style="color: white;background-color:blue">C&oacute;digo Producto</th>
                                        <th style="color: white;background-color:blue">Producto</th>
                                        <th style="color: white;background-color:blue">Unidad Medida</th>
                                        <th style="color: white;background-color:blue">Cantidad</th>
                                        <th style="color: white;background-color:blue">Precio Unitario</th>
                                        <th style="color: white;background-color:blue">Descuento X item</th>
                                        <th style="color: white;background-color:blue">Subtotal</th>
                                        <th style="color: white;background-color:blue">Acciones</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if (isset($detalle_productos))
                                        @forelse (\LukePOLO\LaraCart\Facades\LaraCart::getItems() as $item)
                                            <tr id="{{ $item->id }}">
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->unidad_medida_literal }}</td>
                                                <td><input id="inputCantidad{{ $item->id }}"
                                                        name="{{ $item->id }}" value="{{ $item->qty }}"
                                                        type="number" min="0.00001" step="0.00001"
                                                        onchange="calcularSubTotal(this.name);">
                                                </td>
                                                <td>
                                                    <input id="inputPrecioUnitario{{ $item->id }}"
                                                        name="{{ $item->id }}"
                                                        value="{{ number_format($item->price, 5, '.', '') }}"
                                                        type="number" min="0.00001" step="0.00001"
                                                        onchange='calcularSubTotal(this.name)'>
                                                </td>

                                                <td><input id="inputDescuento{{ $item->id }}"
                                                        name="{{ $item->id }}" value="{{ $item->descuento_item }}"
                                                        type="number" min="0.00000" step="0.00001"
                                                        onchange="calcularSubTotal(this.name);">
                                                </td>
                                                <td>
                                                    <span id="subtotal{{ $item->id }}" name="{{ $item->id }}">
                                                        {{ number_format($item->subtotal, 5, '.', '') }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <button id="{{ $item->id }}" name="{{ $item->id }}"
                                                        type="button" class='btn btn-floating red'
                                                        onclick="cambiarTabla(this.name)">
                                                        <i class='material-icons prefix'>delete</i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br>
                    <br>
                    <h4 class="card-title ">Descripcion y Totales</h4>
                    <div class="divider mb-1 mt-1"></div>
                    <div class="row ">
                        <div class="col s6 m6 l6">
                            <div class="row">
                                <div class="input-field col s12">
                                    <textarea data-length="120" id="nota" name="nota" class="materialize-textarea" placeholder="Nota">
                                        @if (isset($pedido))
{{ $pedido->nota }}
@endif
                                    </textarea>
                                    <label for="nota">Nota/Descripci&oacute;n</label>
                                </div>
                            </div>
                        </div>
                        <div class="col s6 m6 l6 ">
                            <table aria-describedby="totales" class=" bordered">
                                <tbody>
                                    <tr>
                                        <th class="teal lighten-2" style="color: white">Importe Total:</th>
                                        <td>
                                            <span id="importeTotal">Bs.
                                                {{ number_format((float) array_sum(collect(\LukePOLO\LaraCart\Facades\LaraCart::getItems())->pluck('subtotal')->toArray()), 5, '.', '') }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="teal lighten-2" style="color: white">Total D. Adicional:</th>
                                        <td><input
                                                onchange="calcularTotal({{ number_format((float) array_sum(collect(\LukePOLO\LaraCart\Facades\LaraCart::getItems())->pluck('subtotal')->toArray()), 5, '.', '') }})"
                                                name="descuento_adicional" id="descuento_adicional" type="number"
                                                min="0.00001" step="0.00001">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="teal lighten-2" style="color: white">SubTotal:</th>
                                        <td>
                                            <span id="subTotal">
                                                Bs.
                                                {{ number_format((float) array_sum(collect(\LukePOLO\LaraCart\Facades\LaraCart::getItems())->pluck('subtotal')->toArray()), 5, '.', '') }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr id="monto-giftcard-total">
                                        <th class="teal lighten-2" style="color: white">GiftCard:</th>
                                        <td><input
                                                onchange="calcularTotal({{ number_format((float) array_sum(collect(\LukePOLO\LaraCart\Facades\LaraCart::getItems())->pluck('subtotal')->toArray()), 5, '.', '') }})"
                                                name="monto_giftcard" id="monto_giftcard" type="number" min="0.00001"
                                                step="0.00001">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="teal lighten-2" style="color: white">Total:</th>
                                        <td id="total">Bs.&nbsp;
                                            @if (isset($pedido))
                                                {{ $pedido->total }}
                                            @else
                                                {{ number_format((float) \LukePOLO\LaraCart\Facades\LaraCart::subTotal(false), 5, '.', '') }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="teal lighten-2" style="color: white">Tipo Cambio:</th>
                                        <td id="subTotal">
                                            <span style="font-size: 1rem">6.96</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="teal lighten-2" style="color: white">Total Dolar:</th>
                                        <td id="totalDolar">Bs.&nbsp;
                                            @if (isset($pedido))
                                                {{ number_format((float) $pedido->total * 6.96, 5, '.', '') }}
                                            @else
                                                {{ number_format((float) \LukePOLO\LaraCart\Facades\LaraCart::subTotal(false) * 6.96, 5, '.', '') }}
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <input type="hidden" id="id_pedido" name="id_pedido"
                            value="@if (isset($pedido)) {{ $pedido->id }} @endif">

                        <div class="col s12 display-flex justify-content-end mt-3">
                            <button id="registrarVentaButton" type="button" onclick="registrarVenta()"
                                class="btn indigo mr-2">Guardar</button>
                            <button type="button" class="btn btn-light">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- users edit ends -->
    @endsection

    {{-- vendor scripts --}}
    @section('vendor-script')
        <script src="{{ asset('vendors/select2/select2.full.min.js') }}"></script>
        <script src="{{ asset('vendors/jquery-validation/jquery.validate.min.js') }}"></script>
    @endsection

    {{-- page scripts --}}
    @section('page-script')
        <script src="{{ asset('js/scripts/ventas/index.js') }}"></script>
        <script src="{{ asset('js/scripts/ventas/create.js') }}"></script>
        <script>
            let ruta_obtener_cliente = "{{ route('ventas.getDataCliente') }}";
            let ruta_guardar_pedido = "{{ route('pedido.store') }}";
            let ruta_index_pedido = "{{ route('pedido.index') }}";
            let rutal_all_cart = "{{ route('get.all.cart') }}";
            let ruta_remove_item_cart = "{{ route('producto.destroyProducto') }}"
            let ruta_obtener_producto = "{{ route('producto.get.name') }}";
            let ruta_actualizar_cart = "{{ route('update.product.cart') }}"
            let ruta_obtener_subtotal_cart = "{{ route('producto.get.subtotalcart') }}"
            let ruta_registrar_venta = "{{ route('ventas.store') }}"
        </script>
    @endsection
