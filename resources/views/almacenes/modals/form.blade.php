<div id="modalCrearAlmacen" class="modal">
    <form id="formAlmacen">
        <div class="modal-content">
            <h4 id="title-modal-almacen">Crear Almacen</h4>
            <div class="row">
                <div class="input-field col m6 s12">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="autocomplete" id="nombre" name="nombre" placeholder="Nombre">
                </div>
                <div class="input-field col m6 s12">
                    <label for="capacidad_almacen">Capacidad</label>
                    <input type="number" class="autocomplete" id="capacidad_almacen" name="capacidad_almacen"
                        placeholder="Capacidad Almacen">
                </div>
                <div class="input-field col m6 s12">
                    <select id="encargado_id" name="encargado_id" required>
                        <option value="" required disabled selected>Escoga una opcion</option>
                        @foreach ($encargados as $encargado)
                        <option value="{{ $encargado->id }}">{{ $encargado->name }}</option>
                        @endforeach
                    </select>
                    <label for="encargado_id">Seleccione un Encargado</label>
                </div>
                <div class="input-field col m6 s12">
                    <select id="sucursal_id" name="sucursal_id" required>
                        <option value="" required disabled selected>Escoga una opcion</option>
                        @foreach ($sucursales as $sucursal)
                        <option value="{{ $sucursal->id }}">{{ $sucursal->nombre_sucursal }}</option>
                        @endforeach
                    </select>
                    <label for="sucursal_id">Seleccione un Sucursal</label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect red btn  ">Cancelar</a>
            <button type="submit" class="modal-action waves-effect blue btn ">Guardar</button>
        </div>
    </form>
</div>