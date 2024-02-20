<div id="modalCrearFamilia" class="modal">
    <form id="formFamilia">
        <div class="modal-content">
            <h4 id="title-modal-familia">Crear Familia</h4>
            <div class="row">
                <div class="input-field col m12 s12">
                    <label for="nombre_familia">Nombre</label>
                    <input type="text" class="autocomplete" id="nombre_familia" name="nombre_familia"
                        placeholder="Nombre">
                </div>
                <div class="input-field col m12 s12">
                    <select id="estado" name="estado" required>
                        <option value="" required disabled selected>Escoge una opcion</option>
                        <option value="0">Inactivo</option>
                        <option value="1">Activo</option>
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