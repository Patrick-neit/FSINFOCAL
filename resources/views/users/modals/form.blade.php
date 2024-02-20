<div id="modalCrearUsuario" class="modal">
    <form id="formUser">
        <div class="modal-content">
            <h4 id="title-modal-user">Crear Usuario</h4>
            <div class="row">
                <div class="input-field col m6 s12">
                    <input type="text" class="autocomplete" id="nombres" name="nombres" placeholder="Nombres">
                    <label for="nombres">Nombres</label>
                </div>
                <div class="input-field col m6 s12">
                    <input type="text" class="autocomplete" id="apellidos" name="apellidos" placeholder="Apellidos">
                    <label for="apellidos">Apellidos</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m6 s12">
                    <input type="text" class="autocomplete" id="ci" name="ci" placeholder="Carnet de Identidad">
                    <label for="ci">Carnet de Identidad</label>
                </div>
                <div class="input-field col m6 s12">
                    <input type="text" class="autocomplete datepicker" id="fecha_nacimiento" name="fecha_nacimiento"
                        placeholder="Fecha de Nacimiento">
                    <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m6 s12">
                    <input type="email" class="autocomplete" id="email" name="email" placeholder="Correo">
                    <label for="email">Correo</label>
                </div>
                <div class="input-field col m6 s12">
                    <input type="password" class="autocomplete" id="password" name="password" placeholder="Contraseña"
                        value="">
                    <label for="password">Contraseña</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col m6 s12">
                    <select name="departamento_id" id="departamento_id" required>
                        <option value="" required disabled selected>Escoga una opcion</option>
                        <option value="1">Santa Cruz</option>
                        <option value="2">Beni</option>
                        <option value="3">Pando</option>
                        <option value="4">La Paz</option>
                        <option value="5">Cochabamba</option>
                        <option value="6">Oruro</option>
                        <option value="7">Potosi</option>
                        <option value="8">Chuquisaca</option>
                        <option value="9">Tarija</option>
                    </select>
                    <label for="departamento_id">Seleccione un Departamento</label>
                </div>
                <div class="row">
                    <div class="col m6 s12 file-field input-field">
                        <div class="btn float-right">
                            <span>Foto de Perfil</span>
                            <input class="autocomplete" id="avatar" name="avatar" type="file">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" id="avatar" name="avatar" type="text" value="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect red btn  ">Cancelar</a>
            <button type="submit" id="submitUser" class="modal-action waves-effect blue btn ">Guardar</button>
        </div>
    </form>
</div>