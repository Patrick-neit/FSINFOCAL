<div id="modalCrearCliente" class="modal">
    <form id="formCliente">
        <div class="modal-content">
            <h4 id="title-modal-cliente">Crear Cliente</h4>
            <div class="row">
                <div class="col s12 m6 l6 input-field">
                    <input id="nombre_cliente" name="nombre_cliente" type="text" class="autocomplete"
                        placeholder="Nombre" required>
                    <label for="nombre_cliente">Nombre cliente</label>
                </div>
                <div class="col s12 m6 l6 input-field">
                    <select class="form-control" name="documento" id="documento" required>
                        <option value="" disabled selected>Escoge una opcion</option>
                        @foreach ($documentos as $documento)
                        <option value="{{ $documento->codigo_clasificador }}">{{
                            $documento->descripcion }}</option>
                        @endforeach
                    </select>
                    <label for="documento">Tipo Documento</label>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m6 l6 input-field">
                    <input id="numero_nit" name="numero_nit" type="text" class="autocomplete" placeholder="Nit"
                        required>
                    <label for="numero_nit">Nro Nit</label>
                </div>
                <div class="col s12 m6 l6 input-field">
                    <input id="complemento" name="complemento" type="text" class="autocomplete"
                        placeholder="Complemento" required>
                    <label for="complemento">Complemento</label>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m6 l6 input-field">
                    <input id="direccion" name="direccion" type="text" class="autocomplete" placeholder="Direccion"
                        required>
                    <label for="direccion">Direccion</label>
                </div>
                <div class="col s12 m6 l6 input-field">
                    <input id="telefono" name="telefono" type="number" class="autocomplete" placeholder="Telefono"
                        required>
                    <label for="telefono">Telefono</label>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m6 l6 input-field">
                    <input id="correo" name="correo" type="email" class="autocomplete" placeholder="Correo" required>
                    <label for="correo">Correo</label>
                </div>
                <div class="col s12 m6 l6 input-field">
                    <select id="departamento_id" name="departamento_id" required>
                        <option value="" disabled selected>Escoge una opcion</option>
                        <option value="1">La Paz</option>
                        <option value="2">Cochabamba</option>
                        <option value="3">Santa Cruz</option>
                        <option value="4">Oruro</option>
                        <option value="5">Potosi</option>
                        <option value="6">Tarija</option>
                        <option value="7">Beni</option>
                        <option value="8">Pando</option>
                        <option value="9">Chuquisaca</option>
                    </select>
                    <label for="departamento_id">Departamento</label>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m6 l6 input-field">
                    <input id="fecha_cumpleanos" name="fecha_cumpleanos" type="text" placeholder="Fecha de Nacimiento"
                        class="datepicker">
                    <label for="fecha_cumpleanos">Fecha Cumpleaños</label>
                </div>
                <div class="col s12 m6 l6 input-field">
                    <input id="contacto" name="contacto" type="text" class="autocomplete" placeholder="Contacto"
                        required>
                    <label for="contacto">Contacto</label>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m6 l6 input-field">
                    <select class="form-control" name="tipos_precios" id="tipos_precios" required>
                        <option value="" disabled selected>Escoge una opcion</option>
                        @foreach (\App\Enums\TiposPrecios::cases() as $case)
                        <option @if (isset($cliente)) @if ($case->value == $cliente->tipos_precios)
                            selected
                            @endif
                            @endif
                            value="{{ $case->value }}">{{ $case->name }}</option>
                        @endforeach
                    </select>
                    <label for="tipos_precios">Tipos Precios</label>
                </div>
                <div class="col s12 m6 l6 input-field">
                    <select class="form-control" name="estado" id="estado" required>
                        <option value="" disabled selected>Escoge una opcion</option>
                        <option @if (isset($cliente)) @if ($cliente->estado == 1)
                            selected
                            @endif
                            @endif value="1">Activo</option>
                        <option @if (isset($cliente)) @if ($cliente->estado == 0)
                            selected
                            @endif
                            @endif
                            value="0">Inactivo</option>
                    </select>
                    <label for="estado">Estado</label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect red btn  ">Cancelar</a>
            <button type="submit" class="modal-action waves-effect blue btn ">Guardar</button>
        </div>
    </form>
</div>