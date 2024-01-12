<div id="modalCrearUsuario" class="modal">
    <div class="modal-content">
        <h4 id="title-modal-user">Crear Usuario</h4>
        <form>
            <div class="row">
                <div class="input-field col m6 s12">
                    <label for="nombres">Nombres</label>
                    <input type="text" class="autocomplete" id="nombres" placeholder="Nombres">
                </div>
                <div class="input-field col m6 s12">
                    <input type="text" class="autocomplete" id="apellidos" placeholder="Apellidos">
                    <label for="apellidos">Apellidos</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m6 s12">
                    <input type="text" class="autocomplete" id="ci" placeholder="Carnet de Identidad">
                    <label for="ci">Carnet de Identidad</label>
                </div>
                <div class="input-field col m6 s12">
                    <input type="text" class="autocomplete datepicker" id="fecha_nacimiento"
                        placeholder="Fecha de Nacimiento">
                    <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m6 s12">
                    <input type="email" class="autocomplete" id="email" placeholder="Correo">
                    <label for="email">Correo</label>
                </div>
                <div class="input-field col m6 s12">
                    <input type="password" class="autocomplete" id="password" placeholder="Contraseña">
                    <label for="password">Contraseña</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <div class="file-field input-field">
                        <div class="btn">
                            <span>File</span>
                            <input class="autocomplete" id="avatar" type="file">
                        </div>
                        <div class="file-path-wrapper">
                            <i class="material-icons prefix"> attach_file </i>
                            <input class="file-path validate" name="avatar" type="text">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect red btn  ">Cancelar</a>
        <button id="registrarUser" class="modal-action waves-effect blue btn ">Guardar</button>
        <button id="actualizarUser" class="modal-action waves-effect blue btn display-none">Actualizar</button>
    </div>
</div>