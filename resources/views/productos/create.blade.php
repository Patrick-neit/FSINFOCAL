{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Productos')

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
        <form id="formProducto">
            <div class="card-content">
                {{-- IDENTIFICACION --}}
                <div>
                    <div class="card-title">
                        <h4 class="card-title" style="font-weight: bold;text-align:center">IDENTIFICACI&Oacute;N</h4>
                    </div>
                    <div class="divider mb-1"></div>
                    <div class="row">
                        <div class="col s12 m4 l4 input-field">
                            <input placeholder="Codigo" id="codigo_producto" name="codigo_producto" type="text"
                                class="validate"
                                value="@if (isset($cabecera_producto)){{ $cabecera_producto->codigo_producto }}@else{{old('codigo_producto')}}@endif"
                                data-error=".errorTxt1" required>
                            <label for="codigo_producto">C&oacute;digo producto</label>
                        </div>
                        <div class="col s12 m4 l4">
                            <div class="input-field">
                                <input placeholder="Nombre del Producto" id="nombre_producto" name="nombre_producto"
                                    type="text" class="validate"
                                    value="@if (isset($cabecera_producto)){{ $cabecera_producto->nombre_producto }}@else{{old('nombre_producto')}}@endif"
                                    data-error=".errorTxt1" required>
                                <label for="nombre_producto">Nombre del Producto</label>
                            </div>
                        </div>
                        <div class="col s12 m4 l4 ">
                            <div class="input-field">
                                <input placeholder="Codigo de Barra" id="codigo_barra" name="codigo_barra" type="text"
                                    class="validate"
                                    value="@if (isset($cabecera_producto)){{ $cabecera_producto->codigo_barra }}@else{{old('codigo_barra')}}@endif"
                                    data-error=".errorTxt1" required>
                                <label for="codigo_barra">C&oacute;digo Barra</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m4 l4 input-field">
                            <input placeholder="Modelo" id="modelo" name="modelo" type="text" class="validate"
                                value="@if (isset($cabecera_producto)){{ $cabecera_producto->modelo }}@else{{old('modelo')}}@endif"
                                data-error=".errorTxt1" required>
                            <label for="modelo">Modelo</label>
                        </div>
                        <div class="col s12 m4 l4 input-field">
                            <input placeholder="Numero de Serie" id="numero_serie" name="numero_serie" type="text"
                                class="validate"
                                value="@if (isset($cabecera_producto)){{ $cabecera_producto->numero_serie }}@else{{old('numero_serie')}}@endif"
                                data-error=".errorTxt1" required>
                            <label for="numero_serie">N&uacute;mero Serie</label>
                        </div>
                        <div class="col s12 m4 l4 input-field">
                            <input placeholder="Numero Imei" id="numero_imei" name="numero_imei" type="text"
                                class="validate"
                                value="@if (isset($cabecera_producto)){{ $cabecera_producto->numero_imei }}@else{{old('nombre_producto')}}@endif"
                                data-error=".errorTxt1" required>
                            <label for="numero_imei">N&uacute;mero Imei</label>
                        </div>
                    </div>
                </div>
                <br>
                <br>
                {{-- DESCRIPCION --}}
                <div>
                    <div class="card-title">
                        <h4 class="card-title" style="font-weight: bold;text-align:center">DESCRIPCI&Oacute;N</h4>
                    </div>
                    <div class="divider mb-1"></div>
                    <div class="row">
                        <div class="col s12 m4 l4">
                            <label for="unidadmedidadselect2">Unidad de Medida</label>
                            <div class="input-field">
                                <select class="select2 browser-default" name="unidad_medida" id="unidad_medida">
                                    <option selected value="" disabled>Unidad de Medida</option>
                                    @forelse ($unidad_medidas as $unidad_medida)
                                    <option value="{{ $unidad_medida->codigo_clasificador }}"
                                        @if(isset($cabecera_producto)) @if($cabecera_producto->unidad_medida_id ==
                                        $unidad_medida->id)
                                        selected
                                        @endif
                                        @endif
                                        >{{ $unidad_medida->descripcion }}</option>
                                    @empty
                                    <option value="">No hay opciones</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="col s12 m4 l4">
                            <label for="marcaselect2">Marca</label>
                            <div class="input-field">
                                <select class="select2 browser-default" name="marca_id" id="marca_id">
                                    <option value="" disabled selected>Seleccione marca</option>
                                    @forelse ($marcas as $marca)
                                    <option value="{{ $marca->id }}" @if (isset($cabecera_producto))
                                        @if($cabecera_producto->
                                        marca_id == $marca->id)
                                        selected
                                        @endif
                                        @endif
                                        >{{ $marca->nombre_marca }}</option>
                                    @empty
                                    <option value="">No hay opciones</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="col s12 m4 l4 ">
                            <label for="categoriaselect2">Categoria</label>
                            <div class="input-field">
                                <select class="select2 browser-default" name="categoria" id="categoria">
                                    <option value="" disabled selected>Seleccione categoria</option>
                                    @forelse ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}" @if (isset($cabecera_producto) &&
                                        $cabecera_producto->categoria_id == $categoria->id)
                                        selected @endif>
                                        {{$categoria->nombre_categoria }}</option>
                                    @empty
                                    <option value="">No hay opciones</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m4 l4 ">
                            <label for="sub_familiaselect2">Sub Familia</label>
                            <div class="input-field">
                                <select class="select2 browser-default" name="sub_familia" id="sub_familia">
                                    <option value="" disabled selected>Seleccione Sub Familia</option>
                                    @forelse ($sub_familias as $sub_familia)
                                    <option value="{{ $sub_familia->id }}" @if(isset($cabecera_producto) &&
                                        $cabecera_producto->sub_familia_id == $sub_familia->id) selected @endif>
                                        {{$sub_familia->nombre_sub_familia }}
                                    </option>
                                    @empty
                                    <option value="">No hay opciones</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="col s12 m4 l4">
                            <label for="almacenselect2">Almacen</label>
                            <div class=" input-field">
                                <select class="select2 browser-default" name="almacen_id" id="almacen_id">
                                    <option value="" disabled selected>Seleccione Almacen</option>
                                    @forelse ($almacenes as $almacen)
                                    <option value="{{ $almacen->id }}" @if(isset($cabecera_producto) &&
                                        $cabecera_producto->almacenes[0]->id == $almacen->id) selected @endif>
                                        {{ $almacen->nombre }}
                                    </option>
                                    @empty
                                    <option></option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="col s12 m4 l4 ">
                            <label for="dosificacionselect2">Dosificacion</label>
                            <div class="input-field">
                                <select class="select2 browser-default" name="dosificacion" id="dosificacion"
                                    onchange="cargarActividad()">
                                    <option selected value="" disabled>Dosificaci&oacute;n</option>
                                    @forelse ($dosificaciones as $dosificacion)
                                    @forelse ($dosificacion->detalles_dosificaciones_empresas as $detalle)
                                    <option value="{{ $detalle->codigo_actividad_documento_sector }}">{{
                                        $detalle->descripcion_documento_sector }}</option>
                                    @empty
                                    <option value="">No hay opciones</option>
                                    @endforelse
                                    @empty
                                    <option value="">No hay dosificaciones disponibles</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <label for="homologacion">Homologacion</label>
                            <div class=" input-field">
                                <select class="select2 browser-default" name="homologacion" id="homologacion">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m4 l4 input-field">
                            <select class="form-control" name="tipo_producto" id="tipo_producto">
                                <option value="1" @if (isset($cabecera_producto)) @if($cabecera_producto->tipo_id == 1)
                                    selected
                                    @endif
                                    @endif
                                    >Producto</option>
                                <option value="2" @if (isset($cabecera_producto)) @if($cabecera_producto->tipo_id == 2)
                                    selected
                                    @endif
                                    @endif
                                    >Servicio</option>
                            </select>
                            <label>Tipo</label>
                        </div>
                        <div class="col s12 m4 l4 input-field">
                            <select class="form-control" name="estado" id="estado">
                                <option @if (isset($cabecera_producto)) @if ($cabecera_producto->estado == 1)
                                    selected
                                    @endif
                                    @endif value="1">Activo</option>
                                <option @if (isset($cabecera_producto)) @if ($cabecera_producto->estado == 0)
                                    selected
                                    @endif
                                    @endif
                                    value="0">Inactivo</option>
                            </select>
                            <label>Estado</label>
                        </div>
                        <div class="col s12 m4 l4 input-field">
                            <input placeholder="Peso Unitario" id="peso_unitario" name="peso_unitario" type="number"
                                class="validate"
                                value="@if (isset($cabecera_producto)){{ $cabecera_producto->peso_unitario }}@else{{old('peso_unitario')}}@endif"
                                data-error=".errorTxt1" required>
                            <label for="peso_unitario">Peso Unitario</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m4 l4 input-field">
                            <input placeholder="Caracteristica" id="caracteristica" name="caracteristica" type="text"
                                class="validate"
                                value="@if (isset($cabecera_producto)){{ $cabecera_producto->caracteristicas }}@else{{old('caracteristica')}}@endif"
                                data-error=".errorTxt1" required>
                            <label for="caracteristica">Caracteristica</label>
                        </div>
                        <div class="col s12 m4 l4 input-field">
                            <input placeholder="Stock Minimo" id="stock_minimo" name="stock_minimo" type="number"
                                step="0.00001" class="validate"
                                value="@if (isset($cabecera_producto)){{ $cabecera_producto->stock_minimo }}@else{{old('stock_minimo')}}@endif"
                                data-error=".errorTxt1" required>
                            <label for="stock_minimo">Stock M&iacute;nimo</label>
                        </div>
                        <div class="col s12 m4 l4 input-field">
                            <input placeholder="Stock Actual" id="stock_actual" name="stock_actual" type="number"
                                step="0.00001" class="validate"
                                value="@if (isset($cabecera_producto)){{ $cabecera_producto->stock_actual }}@else{{old('stock_actual')}}@endif"
                                data-error=".errorTxt1" required>
                            <label for="stock_actual">Stock Actual</label>
                        </div>
                    </div>
                </div>
                <br>
                <br>
                {{-- PRECIOS --}}
                <div>
                    <div class="card-title">
                        <h4 class="card-title" style="font-weight: bold;text-align:center">CATALOGO DE PRECIOS</h4>
                    </div>
                    <div class="divider mb-1"></div>
                    <div class="row">
                        <div class="col s12 m4 l4 input-field">
                            <input placeholder="Precio de Compra" id="precio_compra" name="precio_compra" type="number"
                                step="0.00001" class="validate"
                                value="@if (isset($detalle_producto)){{ $detalle_producto->precio_compra }}@else{{old('precio_compra')}}@endif"
                                data-error=".errorTxt1" required>
                            <label for="precio_compra">Precio Compra</label>
                        </div>
                        <div class="col s12 m4 l4 input-field">
                            <input placeholder="Precio Unitario" id="precio_unitario" name="precio_unitario"
                                type="number" step="0.00001" class="validate"
                                value="@if (isset($detalle_producto)){{ $detalle_producto->precio_unitario }}@else{{old('precio_unitario')}}@endif"
                                data-error=".errorTxt1" required>
                            <label for="precio_unitario">Precio Unitario</label>
                        </div>
                        <div class="col s12 m4 l4 input-field">
                            <input placeholder="Precio Unitario 2" id="precio_unitario2" name="precio_unitario2"
                                type="number" step="0.00001" class="validate"
                                value="@if (isset($detalle_producto)){{ $detalle_producto->precio_unitario2 }}@else{{old('precio_unitario2')}}@endif"
                                data-error=".errorTxt1" required>
                            <label for="precio_unitario2">Precio Unitario 2</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m4 l4 input-field">
                            <input placeholder="Precio Unitario 3" id="precio_unitario3" name="precio_unitario3"
                                type="number" step="0.00001" class="validate"
                                value="@if (isset($detalle_producto)){{ $detalle_producto->precio_unitario3 }}@else{{old('precio_unitario3')}}@endif"
                                data-error=".errorTxt1" required>
                            <label for="precio_unitario3">Precio Unitario 3</label>
                        </div>
                        <div class="col s12 m4 l4 input-field">
                            <input placeholder="Precio Unitario 4" id="precio_unitario4" name="precio_unitario4"
                                type="number" step="0.00001" class="validate"
                                value="@if (isset($detalle_producto)){{ $detalle_producto->precio_unitario4 }}@else{{old('precio_unitario4')}}@endif"
                                data-error=".errorTxt1" required>
                            <label for="precio_unitario4">Precio Unitario 4</label>
                        </div>
                        <div class="col s12 m4 l4 input-field">
                            <input placeholder="Precio Paquete" id="precio_paquete" name="precio_paquete" type="number"
                                step="0.00001" class="validate"
                                value="@if (isset($detalle_producto)){{ $detalle_producto->precio_paquete }}@else{{old('precio_paquete')}}@endif"
                                data-error=".errorTxt1" required>
                            <label for="precio_paquete">Precio Paquete</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m4 l4 input-field">
                            <input placeholder="Precio Dolar" id="precio_dolar" name="precio_dolar" type="number"
                                step="0.00001" class="validate"
                                value="@if (isset($detalle_producto)){{ $detalle_producto->precio_venta_dolar }}@else{{old('precio_dolar')}}@endif"
                                data-error=".errorTxt1" required>
                            <label for="precio_dolar">Precio Dolar</label>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="id_producto" name="id_producto"
                    value="@if(isset($cabecera_producto)){{ $cabecera_producto->id }}@endif">
                <div class="row">
                    <div class="col s12 display-flex justify-content-end mt-3">
                        <button type="submit" class="btn indigo mr-2">Guardar</button>
                        <button type="button" class="btn btn-light">Cancel</button>
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
<script src="{{asset('vendors/data-tables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('vendors/data-tables/js/datatables.checkboxes.min.js')}}"></script>
<script src="{{asset('vendors/select2/select2.full.min.js') }}"></script>
<script src="{{asset('vendors/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{asset('vendors/jquery-validation/jquery.validate.js') }}"></script>
<script src="{{asset('vendors/jquery-validation/additional-methods.js') }}"></script>
<script src="{{asset('vendors/jquery-validation/additional-methods.min.js') }}"></script>
<script src="{{asset('vendors/jquery-validation/localization/messages_es.js') }}"></script>
@endsection

{{-- page scripts --}}
@section('page-script')
<script src="{{asset('js/scripts/productos/create.js')}}"></script>
<script>
    $(document).ready(function(){
        $('select').formSelect()
    })
</script>
<script>
    let ruta_guardar_producto = "{{route('producto.store')}}";
    let ruta_update_producto = "{{route('producto.update')}}";
    let ruta_index_producto   = "{{route('producto.index')}}";
    let ruta_eliminar_producto = "{{route('producto.destroy')}}";
    let ruta_get_actividad = "{{route('actividad.getActividad')}}";
</script>
@endsection