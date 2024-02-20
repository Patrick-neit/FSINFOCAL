<div id="modalCrearProveedor" class="modal">
    <form id="formProveedor">
        <div class="modal-content">
            <h4 id="title-modal-proveedor">Crear Proveedor</h4>
            <div class="row">
                <div class="col s12 m6">
                    <div class="row">
                        <div class="col s12 input-field">
                            <input id="nombre_proveedor" name="nombre_proveedor" type="text" class="autocomplete"
                                placeholder="Nombre" required>
                            <label for="nombre_proveedor">Nombre proveedor</label>
                        </div>
                    </div>
                </div>
                <div class="col s12 m6">
                    <div class="row">
                        <div class="col s12 input-field">
                            <input id="direccion" name="direccion" type="text" class="autocomplete"
                                placeholder="Direccion" required>
                            <label for="direccion">Direcci&oacute;n</label>
                        </div>
                    </div>
                </div>
                <div class="col s12 m6">
                    <div class="row">
                        <div class="col s12 input-field">
                            <input id="telefono" name="telefono" type="text" class="autocomplete" placeholder="Telefono"
                                required>
                            <label for="telefono">Tel&eacute;fono</label>
                        </div>
                    </div>
                </div>
                <div class="col s12 m6">
                    <div class="row">
                        <div class="col s12 input-field">
                            <input id="rubro" name="rubro" type="text" class="autocomplete" placeholder="Rubro"
                                required>
                            <label for="rubro">Rubro</label>
                        </div>
                    </div>
                </div>
                <div class="col s12 m6">
                    <div class="row">
                        <div class="col s12 input-field">
                            <select name="documentoIdentidad" id="documentoIdentidad" required>
                                <option value="" required disabled selected>Escoge una opcion</option>
                                @forelse ($tipoDocumentos as $tipoDocumento)
                                <option @if (isset($proveedor)) @if ($proveedor->tipo_documento ==
                                    $tipoDocumento->codigo_clasificador)
                                    selected
                                    @endif
                                    @endif
                                    value="{{ $tipoDocumento->codigo_clasificador }}">{{
                                    $tipoDocumento->descripcion }}</option>
                                @empty
                                <option value="">Sin opciones</option>
                                @endforelse
                            </select>
                            <label for="documentoIdentidad">Tipo Documento</label>
                        </div>
                    </div>
                </div>
                <div class="col s12 m6">
                    <div class="row">
                        <div class="col s12 input-field">
                            <input id="numero_documento" name="numero_documento" type="text" class="autocomplete"
                                placeholder="Numero de Documeno" required>
                            <label for="numero_documento">Numero Documento</label>
                        </div>
                    </div>
                </div>
                <div class="col s12 m6">
                    <div class="row">
                        <div class="col s12 input-field">
                            <input id="correo" name="correo" type="email" class="autocomplete" placeholder="Correo"
                                required>
                            <label for="correo">Correo</label>
                        </div>
                    </div>
                </div>
                <div class="col s12 m6">
                    <div class="row">
                        <div class="col s12 input-field">
                            <input id="contacto" name="contacto" type="text" class="autocomplete" placeholder="Contacto"
                                required>
                            <label for="contacto">Contacto</label>
                        </div>
                    </div>
                </div>
                <div class="col s12 m6">
                    <div class="row">
                        <div class="col s12 input-field">
                            <select name="sucursal_id" id="sucursal_id" required>
                                <option value="" disabled selected>Escoge una opcion</option>
                                @forelse ($sucursales as $sucursal)
                                <option @if (isset($proveedor)) @if ($proveedor->sucursal_id ==
                                    $sucursal->id)
                                    selected
                                    @endif
                                    @endif
                                    value="{{ $sucursal->id }}">{{ $sucursal->nombre_sucursal }}
                                </option>
                                @empty
                                <option value="">Sin opciones</option>
                                @endforelse
                            </select>
                            <label>Sucursal</label>
                        </div>
                    </div>
                </div>
                <div class="col s12 m6">
                    <div class="row">
                        <div class="col s12 input-field">
                            <select name="estado" id="estado" required>
                                <option value="" disabled selected>Escoge una opcion</option>
                                <option @if (isset($proveedor)) @if ($proveedor->estado == 1)
                                    selected
                                    @endif
                                    @endif value="1">Activo</option>
                                <option @if (isset($proveedor)) @if ($proveedor->estado == 0)
                                    selected
                                    @endif
                                    @endif
                                    value="0">Inactivo</option>
                            </select>
                            <label>Estado</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect red btn  ">Cancelar</a>
            <button type="submit" class="modal-action waves-effect blue btn ">Guardar</button>
        </div>
    </form>
</div>