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
                        <i class="material-icons mr-1">person_outline</i><span>Gestión marca</span>
                    </a>
                </li>
            </ul>
            <div class="divider mb-3"></div>
            @csrf
            <div class="row">
                <div class="col s12 m8 l4 input-field">
                    <select class="select2 browser-default" name="proveedor_id" id="proveedor_id">
                        <option selected value="" disabled>Seleccione proveedor</option>
                        @forelse ($proveedores as $proveedor)
                        <option value="{{ $proveedor->id }}" @if (isset($cabecera_producto)) @if($cabecera_producto->
                            unidad_medida_id == $unidad_medida->id)
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
                    <input id="fecha_pedido" name="fecha_pedido" type="text" class="datepicker">
                    <label for="fecha_pedido">Fecha Pedido</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m4 offset-m8 l4 offset-l8">
                    <i class="material-icons prefix">date_range</i>
                    <input id="hora_pedido" name="hora_pedido" type="text" class="timepicker">
                    <label for="hora_pedido">Hora Pedido</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m4 offset-m8 l4 offset-l8">
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
                        </tr>
                    </thead>

                    <tbody>
                        @forelse (\LukePOLO\LaraCart\Facades\LaraCart::getItems() as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->unidad_medida_literal }}</td>
                            <td><input id="inputCantidad{{ $item->id }}" name="{{ $item->id }}" value="{{ $item->qty }}"
                                    type="number" min="0.00001" step="0.00001" oninput="calcularSubTotal(this.name);">
                            </td>
                            <td>
                                <input id="inputPrecioUnitario{{ $item->id }}" name="{{ $item->id }}"
                                    value="{{ number_format($item->price, 5, '.', '') }}" type="number" min="0.00001"
                                    step="0.00001" oninput='calcularSubTotal(this.name)'>
                            </td>
                            <td>
                                <span id="subtotal{{ $item->id }}" name="{{ $item->id }}">
                                    {{ number_format($item->subtotal, 5, '.', '') }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col s12 m8 l8 input-field">
                    <textarea id="textarea1" class="materialize-textarea"></textarea>
                    <label for="textarea1">Nota/Descripci&oacute;n</label>
                </div>
                <div class="col s12 m2 l2 input-field">
                    <h6>Total:</h6>
                    <h6>Tipo Cambio:</h6>
                    <h6>Total Dolar:</h6>
                </div>
                <div class="col s12 m2 l2 input-field right-align">
                    <h6 id="subTotal">Bs.&nbsp;{{
                        number_format((float)\LukePOLO\LaraCart\Facades\LaraCart::subTotal(false),
                        5, '.',
                        '') }}
                    </h6>
                    <h6>6.96</h6>
                    <h6 id="totalDolar">Bs.&nbsp;{{
                        number_format((float)(\LukePOLO\LaraCart\Facades\LaraCart::subTotal(false)) * 6.96, 5, '.', '')
                        }}
                    </h6>
                </div>

            </div>
            <div class="row">
                <input type="hidden" id="id_marca" name="id_marca" value="@if(isset($marca)){{ $marca->id }}@endif">

                <div class="col s12 display-flex justify-content-end mt-3">
                    <button id="registrarMarcaButton" class="btn indigo mr-2">Guardar</button>
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
<script src="{{asset('js/scripts/pedidos/create.js')}}"></script>
<script>
    let ruta_guardar_marca = "{{route('marca.store')}}";
    let ruta_index_marca   = "{{route('marca.index')}}";
    let ruta_eliminar_marca = "{{route('marca.destroy')}}";
    let ruta_obtener_producto = "{{route('producto.get.name')}}";
    let ruta_actualizar_cart = "{{ route('update.product.cart') }}"
</script>
@endsection
