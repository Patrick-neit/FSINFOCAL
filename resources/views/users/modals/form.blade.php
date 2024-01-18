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
                <div class="input-field col m6 s12">
                    <select id="departamento_id">
                        <option value="" disabled selected>Escoga una opcion</option>
                        <option value="1">Santa Cruz</option>
                        <option value="2">Beni</option>
                        <option value="3">Pado</option>
                        <option value="4">La Paz</option>
                        <option value="5">Cochabamba</option>
                        <option value="6">Oruro</option>
                        <option value="7">Potosi</option>
                        <option value="8">Chuquisaca</option>
                        <option value="9">Tarija</option>
                    </select>
                    <label>Seleccione un Departamento</label>
                </div>
                <div class="row">
                    <div class="col m6 s12 file-field input-field">
                        <div class="btn float-right">
                            <span>Foto de Perfil</span>
                            <input class="autocomplete" id="avatar" type="file">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" name="avatar" type="text">
                        </div>
                    </div>
                </div>
            </div>
            {{-- Departamentos estaticos--}}
        </form>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect red btn  ">Cancelar</a>
        <button id="registrarUser" class="modal-action waves-effect blue btn ">Guardar</button>
        <button id="actualizarUser" class="modal-action waves-effect blue btn display-none">Actualizar</button>
    </div>
</div>