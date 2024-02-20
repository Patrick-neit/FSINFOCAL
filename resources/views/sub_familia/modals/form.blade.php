<div id="modalCrearSubFamilia" class="modal">
    <form id="formSubFamilia">
        <div class="modal-content">
            <h4 id="title-modal-sub-familia">Crear SubFamilia</h4>
            <div class="row">
                <div class="input-field col m12 s12">
                    <label for="nombre_sub_familia">Nombre</label>
                    <input type="text" class="autocomplete" name="nombre_sub_familia" id="nombre_sub_familia"
                        placeholder="Nombre">
                </div>
                <div class="input-field col m12 s12">
                    <select id="familia_id" name="familia_id" required>
                        <option value="" disabled selected>Escoge una opcion</option>
                        @foreach ($familias as $familia)
                        <option value="{{$familia->id}}">{{ $familia->nombre_familia }}</option>
                        @endforeach
                    </select>
                    <label for="familia_id">Seleccione la familia</label>
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