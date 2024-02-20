<div id="modalCrearConfiguracionImpuesto" class="modal">
    <form id="formConfiguracionImpuesto">
        <div class="modal-content">
            <h4 id="title-modal-configuracion-impuesto">Crear Configuracion Impuesto</h4>
            <div class="row">
                <div class="col s12 m6 l6 input-field">
                    <input id="nombre_sistema" name="nombre_sistema" type="text" class="autocomplete"
                        placeholder="Nombre de sistema" required>
                    <label for="nombre_sistema">Nombre Sistema</label>
                </div>
                <div class="col s12 m6 l6 input-field">
                    <input id="codigo_sistema" name="codigo_sistema" type="text" class="autocomplete"
                        placeholder="Codigo de sistema" required>
                    <label for="codigo_sistema">Codigo Sistema</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m6 l6">
                    <select id="modalidad" name="modalidad" required>
                        <option value="" required disabled selected>Elije una opción</option>
                        <option @if (isset($conf)) @if ($conf->modalidad == 1)
                            selected
                            @endif
                            @endif value="1">Electr&oacute;nica en L&iacute;nea</option>
                        <option @if (isset($conf)) @if ($conf->modalidad == 2)
                            selected
                            @endif
                            @endif value="2">Computarizada en L&iacute;nea</option>
                    </select>
                    <label for="modalidad"> Selecciona Modalidad</label>
                </div>
                <div class="input-field col s12 m6 l6">
                    <select id="ambiente" name="ambiente" required>
                        <option value="" required disabled selected>Elije una opción</option>
                        <option @if (isset($conf)) @if ($conf->ambiente == 1)
                            selected
                            @endif
                            @endif value="1">Produccion </option>
                        <option @if (isset($conf)) @if ($conf->ambiente == 2)
                            selected
                            @endif
                            @endif value="2">Pruebas</option>
                    </select>
                    <label for="ambiente"> Selecciona Ambiente</label>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m6 l6 input-field">
                    <select name="empresa_id" id="empresa_id" disabled>
                        @foreach ($enterprises as $enterprise)
                        <option @if (isset($conf)) @if ($conf->empresa_id == $enterprise->id)
                            selected
                            @endif
                            @endif
                            value="{{ $enterprise->id }}">{{ $enterprise->nombre_empresa }}</option>
                        @endforeach
                    </select>
                    <label for="empresa_id">Asociar Empresa</label>
                </div>
                <div class="col s12 m6 l6 input-field">
                    <select name="estado" id="estado" required>
                        <option value="" required disabled selected>Escoga una opcion</option>
                        <option @if (isset($conf)) @if ($conf->estado == 1)
                            selected
                            @endif
                            @endif value="1">Activo</option>
                        <option @if (isset($conf)) @if ($conf ->estado == 0)
                            selected
                            @endif
                            @endif
                            value="0">Inactivo</option>
                    </select>
                    <label for="estado">Estado</label>
                </div>
            </div>
            <div class="row">
                <div class="col s12 input-field">
                    <textarea placeholder="Token Sistema" id="token_sistema" name="token_sistema"
                        class="materialize-textarea" placeholder="Token">@if (isset($conf)) {{ $conf->token_sistema
                        }}@endif</textarea>
                    <label for="token_sistema">Token Sistema</label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect red btn  ">Cancelar</a>
            <button type="submit" class="modal-action waves-effect blue btn ">Guardar</button>
        </div>
    </form>
</div>