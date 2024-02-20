<div id="modalCrearDosificacion" class="modal">
    <form id="formDosificacion">
        <div class="modal-content">
            <h4 id="title-modal-dosificacion">Crear Dosificacion</h4>
            <div class="row">
                <input type="hidden" value="{{$empresa->id}}" id="empresa_id">
                <div class="row">
                    <div class="col s12 input-field">
                        <input placeholder="Empresa" id="empresa_nombre" name="empresa_nombre" type="text"
                            class="validate" value="{{ $empresa->nombre_empresa }}" readonly>
                        <label for="empresa_nombre">Empresa Usuario</label>
                    </div>
                    <div class="col s6 m4 input-field">
                        <label>Numeracion Inicio Facturas</label>
                        <input placeholder="Numero Inicial Factura" id="nro_inicio_factura" name="nro_inicio_factura"
                            type="text" class="validate">
                    </div>
                    <div class="col s6 m4 input-field">
                        <label>Numeracion Fin Facturas</label>
                        <input placeholder="Numero Final Factura" id="nro_fin_factura" name="nro_fin_factura"
                            type="text" class="validate">
                    </div>
                    <div class="col s6 m4 input-field">
                        <input placeholder="Cafc" id="empresa_cafc" name="empresa_cafc" type="text" class="validate">
                        <label for="empresa_cafc">Cafc</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m6">
                        <label>Tipos Facturas</label>
                        <div class="input-field">
                            <select name="tipo_factura_id" id="tipo_factura_id" class="select2 browser-default">
                                <option value="" selected disabled>Seleccione una opcion</option>
                                @foreach ($tiposFacturas as $tipoFactura )
                                <option value="{{$tipoFactura->codigo_clasificador}}">{{$tipoFactura->descripcion}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col s12 m6">
                        <label>Documento Sector Empresa</label>
                        <div class="input-field">
                            <select name="documento_sector_id" id="documento_sector_id" onchange="handleChangeDSInput()"
                                class="select2 browser-default">
                                <option value="" selected disabled>Seleccione una opcion</option>
                                @foreach ($documentoSectores as $documento )
                                <option value="{{ $documento->codigo_clasificador }}">{{$documento->descripcion}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col s12">
                    <table class="mt-1">
                        <thead>
                            <tr>
                                <th>Empresa Dosificacion</th>
                                <th>Descripcion DS</th>
                                <th>Tipo Factura DS</th>
                                <th>ACCION</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            @if (session('dosificaciones_sucursales_detalle'))
                            @foreach (session('dosificaciones_sucursales_detalle') as $indice => $item)
                            <tr>
                                <td style="text-align: center;">
                                    {{ $item['empresa_nombre'] }}
                                </td>
                                <td style="text-align: center;"> {{ $item['descripcion_ds'] }} </td>
                                <td style="text-align: center;"> {{ $item['tipo_factura_ds'] }} </td>
                                <td style="text-align: center;">
                                    <button type="button" class="btn btn-danger" onclick="eliminar(i);">
                                        <i class="material-icons">delete</i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect red btn  ">Cancelar</a>
            <button type="submit" class="modal-action waves-effect blue btn ">Guardar</button>
        </div>
    </form>
</div>