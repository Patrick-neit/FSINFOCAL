<div id="modalCrearEmpresa" class="modal">
    <form id="formEmpresa">
        <div class="modal-content">
            <h4 id="title-modal-empresa">Crear Empresa</h4>
            <div class="row">
                <div class="input-field col m6 s12">
                    <label for="nombre_empresa">Nombre</label>
                    <input type="text" class="autocomplete" id="nombre_empresa" name="nombre_empresa"
                        placeholder="Nombre">
                </div>
                <div class="input-field col m6 s12">
                    <label for="nro_nit_empresa">Nit</label>
                    <input type="text" class="autocomplete" id="nro_nit_empresa" name="nro_nit_empresa"
                        placeholder="Nit">
                </div>
                <div class="input-field col m6 s12">
                    <label for="direccion">Direccion</label>
                    <input type="text" class="autocomplete" id="direccion" name="direccion" placeholder="Direccion">
                </div>
                <div class="input-field col m6 s12">
                    <label for="telefono">Telefono</label>
                    <input type="number" class="autocomplete" id="telefono" name="telefono" placeholder="Telefono">
                </div>
                <div class="input-field col m6 s12">
                    <label for="correo">Correo</label>
                    <input type="email" class="autocomplete" id="correo" name="correo" placeholder="Correo">
                </div>
                <div class="input-field col m6 s12">
                    <label for="representante_legal">Representante Legal</label>
                    <input type="text" class="autocomplete" id="representante_legal" name="representante_legal"
                        placeholder="Representante Legal">
                </div>
                <div class="input-field col m6 s12">
                    <select id="estado" name="estado" required>
                        <option value="" required disabled selected>Escoge una opcion</option>
                        <option value="0">Inactivo</option>
                        <option value="1">Activo</option>
                    </select>
                    <label for="estado">Estado</label>
                </div>
                <div class="file-field input-field col m6 s12">
                    <div class="btn float-right">
                        <span>Logo</span>
                        <input class="autocomplete" id="logo" name="logo" type="file">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" name="logo" type="text">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect red btn  ">Cancelar</a>
            <button type="submit" id="submitEmpresa" class="modal-action waves-effect blue btn ">Guardar</button>
        </div>
    </form>
</div>