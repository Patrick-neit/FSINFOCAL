<div id="modalCrearPuntoVenta" class="modal">
    <form id="formPuntoVenta">
        <div class="modal-content">
            <h4 id="title-modal-punto-venta">Crear Punto Venta</h4>
            <div class="row">
                <div class="input-field col m6 s12">
                    <label for="nombre_punto_venta">Nombre Punto Venta</label>
                    <input placeholder="Nombre Punto Venta" id="nombre_punto_venta" name="nombre_punto_venta"
                        type="text" class="validate" value="{{ old('nombre_punto_venta') }}" data-error=".errorTxt1"
                        required>
                    <small class="errorTxt1"></small>
                </div>
                <div class="input-field col m6 s12">
                    <select name="sucursal_id" id="sucursal_id" required>
                        <option value="" required disabled selected>Escoga una opcion</option>
                        @foreach ($sucursales as $sucursal)
                            <option value="{{ $sucursal->id }}">{{ $sucursal->nombre_sucursal }}
                            </option>
                        @endforeach
                    </select>
                    <label for="sucursal_id">Asociar Sucursal</label>
                </div>
                <div class="input-field col m6 s12">
                    <label for="descripcion_punto_venta">Descripcion Punto Venta</label>
                    <input placeholder="Descripcion Punto Venta" id="descripcion_punto_venta"
                        name="descripcion_punto_venta" type="text" class="validate"
                        value="{{ old('descripcion_punto_venta') }}" data-error=".errorTxt2" required>
                    <small class="errorTxt2"></small>
                </div>
                <div class="input-field col m6 s12">
                    <select id="tipo_punto_venta" name="tipo_punto_venta" required>
                        <option value="" required disabled selected>Escoga una opcion</option>
                        <option value="0" required>No corresponde</option>
                        @foreach ($tipoPuntosVentas as $puntoVenta)
                            <option value="{{ $puntoVenta->codigo_clasificador }}">{{ $puntoVenta->descripcion }}
                            </option>
                        @endforeach
                    </select>
                    <label for="tipo_punto_venta"> Tipo Punto Venta</label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect red btn  ">Cancelar</a>
            <button type="submit" class="modal-action waves-effect blue btn ">Guardar</button>
        </div>
    </form>
</div>
