<div id="modalCrearMarca" class="modal">
    <form id="formMarca">
        <div class="modal-content">
            <h4 id="title-modal-marca">Crear Marca</h4>
            <div class="row">
                <div class="input-field col m12 s12">
                    <label for="nombre_marca">Nombre</label>
                    <input type="text" class="autocomplete" id="nombre_marca" name="nombre_marca" placeholder="Nombre">
                </div>
                <div class="input-field col m12 s12">
                    <select id="estado" name="estado" required>
                        <option value="" disabled selected>Escoge una opcion</option>
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