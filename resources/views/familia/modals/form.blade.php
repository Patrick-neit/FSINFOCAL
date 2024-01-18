<div id="modalCrearFamilia" class="modal">
    <div class="modal-content">
        <h4 id="title-modal-familia">Crear Familia</h4>
        <form>
            <div class="row">
                <div class="input-field col m12 s12">
                    <label for="nombre_familia">Nombre</label>
                    <input type="text" class="autocomplete" id="nombre_familia" placeholder="Nombre">
                </div>
                <div class="input-field col m12 s12">
                    <select id="estado">
                        <option value="" disabled selected>Escoge una opcion</option>
                        <option value="0">Inactivo</option>
                        <option value="1">Activo</option>
                    </select>
                    <label >Estado</label>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect red btn  ">Cancelar</a>
        <button id="registrarFamilia" class="modal-action waves-effect blue btn ">Guardar</button>
        <button id="actualizarFamilia" class="modal-action waves-effect blue btn display-none">Actualizar</button>
    </div>
</div>