{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Nueva producto')

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
                        <i class="material-icons mr-1">person_outline</i><span>Gestión Producto</span>
                    </a>
                </li>
            </ul>
            <div class="divider mb-3"></div>
            <div class="row">
                <div class="col s12" id="account">
                    <!-- users edit account form start -->
                    <form>
                        @csrf
                        <div class="row">
                            <div class="col s12 m4">
                                <div class="row">
                                    <div class="col s12 input-field">
                                        <select class="form-control" name="dosificacion" id="dosificacion">
                                            <select class="form-control" name="dosificacion" id="dosificacion">
                                                @forelse ($dosificaciones as $dosificacion)
                                                    @forelse ($dosificacion->detalles_dosificaciones_empresas as $detalle)

                                                        <option value="{{ $detalle->codigo_actividad_documento_sector }}">
                                                            {{ $detalle->descripcion_documento_sector }}
                                                        </option>
                                                    @empty
                                                        <option value="">No hay opciones</option>
                                                    @endforelse
                                                @empty
                                                    <option value="">No hay dosificaciones disponibles</option>
                                                @endforelse
                                            </select>
                                        </select>
                                        <label>Dosificaci&oacute;n</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m4">
                                <div class="row">
                                    <div class="col s12 input-field">
                                        <select class="form-control" name="unidad_medida" id="unidad_medida">
                                            @forelse ($unidad_medidas as $unidad_medida)
                                            <option value="{{ $unidad_medida->codigo_clasificador }}">{{
                                                $unidad_medida->descripcion }}</option>
                                            @empty
                                            <option value="">No hay opciones</option>
                                            @endforelse
                                        </select>
                                        <label>Unidad Medida</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m4">
                                <div class="row">
                                    <div class="col s12 input-field">
                                        <select class="form-control" name="marca_id" id="marca_id">
                                            @forelse ($marcas as $marca)
                                            <option value="{{ $marca->id }}">{{ $marca->nombre_marca }}</option>
                                            @empty
                                            <option value="">No hay opciones</option>
                                            @endforelse
                                        </select>
                                        <label>Marca</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m4">
                                <div class="row">
                                    <div class="col s12 input-field">
                                        <select class="form-control" name="categoria" id="categoria">
                                            @forelse ($categorias as $categoria)
                                            <option value="{{ $categoria->id }}">{{
                                                $categoria->nombre_categoria }}</option>
                                            @empty
                                            <option value="">No hay opciones</option>
                                            @endforelse
                                        </select>
                                        <label>Categoria</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m4">
                                <div class="row">
                                    <div class="col s12 input-field">
                                        <select class="form-control" name="tipo_producto" id="tipo_producto">
                                            <option value="1">Producto</option>
                                            <option value="2">Servicio</option>
                                        </select>
                                        <label>Tipo Producto</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m4">
                                <div class="row">
                                    <div class="col s12 input-field">
                                        <select class="form-control" name="sub_familia" id="sub_familia">
                                            @forelse ($sub_familias as $sub_familia)
                                            <option value="{{ $sub_familia->id }}">{{
                                                $sub_familia->nombre_sub_familia }}</option>
                                            @empty
                                            <option value="">No hay opciones</option>
                                            @endforelse
                                        </select>
                                        <label>Sub Familia</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m4">
                                <div class="row">
                                    <div class="col s12 input-field">
                                        <input id="codigo_producto" name="codigo_producto" type="text" class="validate"
                                            value="@if (isset($producto)){{ $producto->codigo_producto }}@else{{old('codigo_producto')}}@endif"
                                            data-error=".errorTxt1" required>
                                        <label for="codigo_producto">C&oacute;digo producto</label>
                                        <small class="errorTxt1"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m4">
                                <div class="row">
                                    <div class="col s12 input-field">
                                        <input id="nombre_producto" name="nombre_producto" type="text" class="validate"
                                            value="@if (isset($producto)){{ $producto->nombre_producto }}@else{{old('nombre_producto')}}@endif"
                                            data-error=".errorTxt1" required>
                                        <label for="nombre_producto">Nombre producto</label>
                                        <small class="errorTxt1"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m4">
                                <div class="row">
                                    <div class="col s12 input-field">
                                        <select class="form-control" name="homologacion" id="homologacion">
                                            @forelse ($produto_servicios as $producto_servicio)
                                            <option value="{{ $producto_servicio->codigo_producto }}">{{
                                                $producto_servicio->descripcion_producto }}</option>
                                            @empty
                                            <option value="">No hay opciones</option>
                                            @endforelse
                                        </select>
                                        <label>Homologaci&oacute;n</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m4">
                                <div class="row">
                                    <div class="col s12 input-field">
                                        <input id="modelo" name="modelo" type="text" class="validate"
                                            value="@if (isset($producto)){{ $producto->modelo }}@else{{old('modelo')}}@endif"
                                            data-error=".errorTxt1" required>
                                        <label for="modelo">Modelo</label>
                                        <small class="errorTxt1"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m4">
                                <div class="row">
                                    <div class="col s12 input-field">
                                        <input id="numero_serie" name="numero_serie" type="text" class="validate"
                                            value="@if (isset($producto)){{ $producto->numero_serie }}@else{{old('numero_serie')}}@endif"
                                            data-error=".errorTxt1" required>
                                        <label for="numero_serie">N&uacute;mero Serie</label>
                                        <small class="errorTxt1"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m4">
                                <div class="row">
                                    <div class="col s12 input-field">
                                        <input id="numero_imei" name="numero_imei" type="text" class="validate"
                                            value="@if (isset($producto)){{ $producto->numero_imei }}@else{{old('nombre_producto')}}@endif"
                                            data-error=".errorTxt1" required>
                                        <label for="numero_imei">N&uacute;mero Imei</label>
                                        <small class="errorTxt1"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m4">
                                <div class="row">
                                    <div class="col s12 input-field">
                                        <input id="precio_unitario" name="precio_unitario" type="number"
                                            class="validate"
                                            value="@if (isset($producto)){{ $producto->precio_unitario }}@else{{old('precio_unitario')}}@endif"
                                            data-error=".errorTxt1" required>
                                        <label for="precio_unitario">Precio Unitario</label>
                                        <small class="errorTxt1"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m4">
                                <div class="row">
                                    <div class="col s12 input-field">
                                        <input id="codigo_barra" name="codigo_barra" type="text" class="validate"
                                            value="@if (isset($producto)){{ $producto->codigo_barra }}@else{{old('codigo_barra')}}@endif"
                                            data-error=".errorTxt1" required>
                                        <label for="codigo_barra">C&oacute;digo Barra</label>
                                        <small class="errorTxt1"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m4">
                                <div class="row">
                                    <div class="col s12 input-field">
                                        <input id="caracteristica" name="caracteristica" type="text" class="validate"
                                            value="@if (isset($producto)){{ $producto->caracteristica }}@else{{old('caracteristica')}}@endif"
                                            data-error=".errorTxt1" required>
                                        <label for="caracteristica">Caracteristica</label>
                                        <small class="errorTxt1"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m4">
                                <div class="row">
                                    <div class="col s12 input-field">
                                        <input id="stock_minimo" name="stock_minimo" type="number" step="0.00001"
                                            class="validate"
                                            value="@if (isset($producto)){{ $producto->stock_minimo }}@else{{old('stock_minimo')}}@endif"
                                            data-error=".errorTxt1" required>
                                        <label for="stock_minimo">Stock M&iacute;nimo</label>
                                        <small class="errorTxt1"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m4">
                                <div class="row">
                                    <div class="col s12 input-field">
                                        <select class="form-control" name="estado" id="estado">
                                            <option @if (isset($producto)) @if ($producto->estado == 1)
                                                selected
                                                @endif
                                                @endif value="1">Activo</option>
                                            <option @if (isset($producto)) @if ($producto->estado == 0)
                                                selected
                                                @endif
                                                @endif
                                                value="0">Inactivo</option>
                                        </select>
                                        <label>Estado</label>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="id_producto" name="id_producto"
                                value="@if(isset($producto)){{ $producto->id }}@endif">
                        </div>
                    </form>
                    <!-- users edit account form ends -->
                </div>
            </div>
            <!-- </div> -->
        </div>
    </div>
    <div class="card">
        <div class="card-content">
            <div class="row">
                <div class="col s12" id="account2">
                    <!-- users edit account form start -->
                    <form>
                        @csrf
                        <div class="row">
                            <div class="col s12 m4">
                                <div class="row">
                                    <div class="col s12 input-field">
                                        <input id="precio_compra" name="precio_compra" type="number" step="0.00001"
                                            class="validate"
                                            value="@if (isset($producto)){{ $producto->precio_compra }}@else{{old('precio_compra')}}@endif"
                                            data-error=".errorTxt1" required>
                                        <label for="precio_compra">Precio Compra</label>
                                        <small class="errorTxt1"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m4">
                                <div class="row">
                                    <div class="col s12 input-field">
                                        <input id="precio_unitarioo" name="precio_unitarioo" type="number"
                                            step="0.00001" class="validate"
                                            value="@if (isset($producto)){{ $producto->precio_unitario }}@else{{old('precio_unitario')}}@endif"
                                            data-error=".errorTxt1" required>
                                        <label for="precio_unitarioo">Precio Unitario</label>
                                        <small class="errorTxt1"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m4">
                                <div class="row">
                                    <div class="col s12 input-field">
                                        <input id="precio_unitario2" name="precio_unitario2" type="number"
                                            step="0.00001" class="validate"
                                            value="@if (isset($producto)){{ $producto->precio_unitario2 }}@else{{old('precio_unitario2')}}@endif"
                                            data-error=".errorTxt1" required>
                                        <label for="precio_unitario2">Precio Unitario 2</label>
                                        <small class="errorTxt1"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m4">
                                <div class="row">
                                    <div class="col s12 input-field">
                                        <input id="precio_unitario3" name="precio_unitario3" type="number"
                                            step="0.00001" class="validate"
                                            value="@if (isset($producto)){{ $producto->precio_unitario3 }}@else{{old('precio_unitario3')}}@endif"
                                            data-error=".errorTxt1" required>
                                        <label for="precio_unitario3">Precio Unitario 3</label>
                                        <small class="errorTxt1"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m4">
                                <div class="row">
                                    <div class="col s12 input-field">
                                        <input id="precio_unitario4" name="precio_unitario4" type="number"
                                            step="0.00001" class="validate"
                                            value="@if (isset($producto)){{ $producto->precio_unitario4 }}@else{{old('precio_unitario4')}}@endif"
                                            data-error=".errorTxt1" required>
                                        <label for="precio_unitario4">Precio Unitario 4</label>
                                        <small class="errorTxt1"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m4">
                                <div class="row">
                                    <div class="col s12 input-field">
                                        <input id="precio_paquete" name="precio_paquete" type="number" step="0.00001"
                                            class="validate"
                                            value="@if (isset($producto)){{ $producto->precio_paquete }}@else{{old('precio_paquete')}}@endif"
                                            data-error=".errorTxt1" required>
                                        <label for="precio_paquete">Precio Paquete</label>
                                        <small class="errorTxt1"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m4">
                                <div class="row">
                                    <div class="col s12 input-field">
                                        <input id="precio_dolar" name="precio_dolar" type="number" step="0.00001"
                                            class="validate"
                                            value="@if (isset($producto)){{ $producto->precio_dolar }}@else{{old('precio_dolar')}}@endif"
                                            data-error=".errorTxt1" required>
                                        <label for="precio_dolar">Precio Paquete</label>
                                        <small class="errorTxt1"></small>
                                    </div>
                                </div>
                            </div>

                            <div class="col s12 display-flex justify-content-end mt-3">
                                <button id="registrarProductoButton" class="btn indigo mr-2">Guardar</button>
                                <button type="button" class="btn btn-light">Cancel</button>
                            </div>
                        </div>
                    </form>
                    <!-- users edit account form ends -->
                </div>
            </div>
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
<script src="{{asset('js/scripts/productos/create.js')}}"></script>
<script>
    let ruta_guardar_producto = "{{route('producto.store')}}";
    let ruta_index_producto   = "{{route('producto.index')}}";
    let ruta_eliminar_producto = "{{route('producto.destroy')}}";
</script>
@endsection