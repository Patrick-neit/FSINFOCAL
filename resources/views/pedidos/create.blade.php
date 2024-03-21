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
            <form id="formPedido">
                <div class="card-content">
                    <h4 class="card-title">Datos Generales</h4>
                    <div class="divider mb-1 mt-1"></div>
                    <div class="row">
                        <div class="col s12 m6 l6">
                            <div class="input-field">
                                <input placeholder="Fecha Pedido" id="fecha_pedido" name="fecha_pedido" type="text"
                                    class="datepicker"
                                    value="@if (isset($pedido)) {{ $pedido->fecha }} @endif">
                                <label for="fecha_pedido">Fecha Pedido</label>
                            </div>
                        </div>
                        <div class="col s12 m6 l6">
                            <div class="input-field">
                                <input placeholder="Hora Pedido" id="hora_pedido" name="hora_pedido" type="text"
                                    class="timepicker" value="@if (isset($pedido)) {{ $pedido->hora }} @endif">
                                <label for="hora_pedido">Hora Pedido</label>
                            </div>
                        </div>
                        <div class="col s12 m6 l6">
                            <label for="">Proveedor</label>
                            <div class="input-field">
                                <select class="select2 browser-default" name="proveedor_id" id="proveedor_id">
                                    <option selected value="" disabled>Seleccione proveedor</option>
                                    @forelse ($proveedores as $proveedor)
                                        <option value="{{ $proveedor->id }}"
                                            @if (isset($pedido)) @if ($pedido->proveedor_id == $proveedor->id)
                                    selected @endif
                                            @endif
                                            >{{ $proveedor->nombre_proveedor }}</option>
                                        @empty
                                            <option value="">No hay opciones</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br>
                        <h4 class="card-title">Detalle del Pedido</h4>
                        <div class="divider mb-1 mt-1"></div>
                        <div class="row">
                            <div class="col s12 m12 l12">
                                <label for="">Adicione el Producto</label>
                                <div class="input-field">
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
                            <div class="col s12 m12 l12">
                                <table aria-describedby="detalle_pedido" id="tableDetalleProducto" class="responsive-table">
                                    <thead class=" ">
                                        <tr>
                                            <th style="color: white;background-color:blue">C&oacute;digo Producto</th>
                                            <th style="color: white;background-color:blue">Producto</th>
                                            <th style="color: white;background-color:blue">Unidad Medida</th>
                                            <th style="color: white;background-color:blue">Cantidad</th>
                                            <th style="color: white;background-color:blue">Precio Unitario</th>
                                            <th style="color: white;background-color:blue">Subtotal</th>
                                            <th style="color: white;background-color:blue">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse (\LukePOLO\LaraCart\Facades\LaraCart::getItems() as $item)
                                            <tr id="{{ $item->id }}">
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->unidad_medida_literal }}</td>
                                                <td><input id="inputCantidad{{ $item->id }}" name="{{ $item->id }}"
                                                        value="{{ $item->qty }}" type="number" min="0.00001"
                                                        step="0.00001" onchange="calcularSubTotal(this.name);">
                                                </td>
                                                <td>
                                                    <input id="inputPrecioUnitario{{ $item->id }}"
                                                        name="{{ $item->id }}"
                                                        value="{{ number_format($item->price, 5, '.', '') }}" type="number"
                                                        min="0.00001" step="0.00001" onchange='calcularSubTotal(this.name)'>
                                                </td>
                                                <td>
                                                    <span id="subtotal{{ $item->id }}" name="{{ $item->id }}">
                                                        {{ number_format($item->subtotal, 5, '.', '') }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <button type="button" id="{{ $item->id }}" name="{{ $item->id }}"
                                                        class='btn btn-floating red'
                                                        onclick="deleteRowCustom('{{ $item->id }}')">
                                                        <i class='material-icons prefix'>delete</i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
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
                                @if (isset($pedido)){{ $pedido->nota }}@endif
                            </textarea>
                                        <label for="nota">Nota/Descripci&oacute;n</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col s6 m6 l6 ">
                                <table aria-describedby="totales" class=" bordered">
                                    <tbody>
                                        <tr>
                                            <th class="teal lighten-2" style="color: white">Tipo Cambio:</th>
                                            <td>Bs.&nbsp; 6.96</td>
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
                                        <tr>
                                            <th class="teal lighten-2" style="color: white">Total:</th>
                                            <td id="subTotal">Bs.&nbsp;
                                                @if (isset($pedido))
                                                    {{ $pedido->total }}
                                                @else
                                                    {{ number_format((float) \LukePOLO\LaraCart\Facades\LaraCart::subTotal(false), 5, '.', '') }}
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
                                <button type="submit" class="btn indigo mr-2">Guardar</button>
                                <a href="{{ route('pedido.index') }}" class="btn btn-light">Cancelar</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- users edit ends -->
    @endsection

    {{-- vendor scripts --}}
    @section('vendor-script')
        <script src="{{ asset('vendors/data-tables/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('vendors/data-tables/js/datatables.checkboxes.min.js') }}"></script>
        <script src="{{ asset('vendors/select2/select2.full.min.js') }}"></script>
        <script src="{{ asset('vendors/jquery-validation/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('vendors/jquery-validation/jquery.validate.js') }}"></script>
        <script src="{{ asset('vendors/jquery-validation/additional-methods.js') }}"></script>
        <script src="{{ asset('vendors/jquery-validation/additional-methods.min.js') }}"></script>
        <script src="{{ asset('vendors/jquery-validation/localization/messages_es.js') }}"></script>
    @endsection

    {{-- page scripts --}}
    @section('page-script')
        <script type="text/javascript">
            let pedido = @json($pedido ?? '');
        </script>
        <script src="{{ asset('js/scripts/pedidos/create.js') }}"></script>
        <script>
            let ruta_guardar_pedido = "{{ route('pedido.store') }}";
            let ruta_index_pedido = "{{ route('pedido.index') }}";
            let rutal_all_cart = "{{ route('get.all.cart') }}";
            let ruta_eliminar_marca = "{{ route('marca.destroy') }}";
            let ruta_obtener_producto = "{{ route('producto.get.name') }}";
            let ruta_actualizar_cart = "{{ route('update.product.cart') }}"
            let ruta_remove_item_cart = "{{ route('producto.destroyProducto') }}"
        </script>
    @endsection
