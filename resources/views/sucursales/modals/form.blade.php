<div id="modalCrearSucursal" class="modal">
    <form id="formSucursal">
        <div class="modal-content">
            <h4 id="title-modal-sucursal">Crear Sucursal</h4>
            <div class="row">
                <div class="input-field col m6 s12">
                    <label for="nombre_sucursal">Nombre</label>
                    <input type="text" class="autocomplete" id="nombre_sucursal" name="nombre_sucursal"
                        placeholder="Nombre">
                </div>
                <div class="input-field col m6 s12">
                    <label for="direccion">Direccion</label>
                    <input type="text" class="autocomplete" id="direccion" name="direccion" placeholder="Nit">
                </div>
                <div class="input-field col m6 s12">
                    <label for="codigo_sucursal">Codigo Sucursal</label>
                    <input type="text" class="autocomplete" id="codigo_sucursal" name="codigo_sucursal"
                        placeholder="Direccion">
                </div>
                <div class="input-field col m6 s12">
                    <label for="telefono">Telefono</label>
                    <input type="number" class="autocomplete" id="telefono" name="telefono" placeholder="Telefono">
                </div>
                <div class="input-field col m6 s12">
                    <select id="empresa_id" name="empresa_id" required>
                        <option value="" required disabled selected>Escoga una opcion</option>
                        @foreach ($empresas as $empresa)
                        <option value="{{ $empresa->id }}">{{ $empresa->nombre_empresa }}</option>
                        @endforeach
                    </select>
                    <label for="empresa_id">Seleccione una Empresa</label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect red btn  ">Cancelar</a>
            <button type="submit" class="modal-action waves-effect blue btn ">Guardar</button>
        </div>
    </form>
</div>