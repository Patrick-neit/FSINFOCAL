$(document).ready(function () {
    const titleModalDosificacion = $("#title-modal-dosificacion")
    $('tbody').on('click', '#editarDosificacion', function (e) {
        $("#formDosificacion").validate().resetForm();
        $('input').removeClass('invalid');
        const dosificacion = $(this).data('dosificacion');
        titleModalDosificacion.html('Actualizar Dosificacion')
        dosificacion_id = dosificacion.id;
        // ruta_update_dosificacion = ruta_update_dosificacion.replace('dosificacion_id', dosificacion_id)
        $("#empresa_nombre").val(dosificacion.empresa.nombre_empresa);
        $("#nro_inicio_factura").val(dosificacion.inicio_nro_factura);
        $("#nro_fin_factura").val(dosificacion.fin_nro_factura);
        $("#empresa_cafc").val(dosificacion.cafc);
        let opciones = updateDSTableEdit(dosificacion.detalles_dosificaciones_empresas)

        document.getElementById("tbody").innerHTML = opciones;
        $('#modalCrearDosificacion').show();
    });
});

function updateDSTableEdit(detalle) {
    let opciones = "";
    for (let i in detalle) {
        opciones += "<tr>";
        opciones +=
            '<td style="text-align: center;">' +
            detalle[i]['dosificacion_empresa']["empresa"]['nombre_empresa'] +
            "</td>";
        opciones +=
            '<td style="text-align: center;">' +
            detalle[i]["tipo_factura_documento_sector"]['descripcion'] +
            "</td>";
        opciones +=
            '<td style="text-align: center;">' +
            detalle[i]["descripcion_documento_sector"] +
            "</td>";
        opciones +=
            '<td style="text-align: center;">' +
            '<button type="button" class="btn btn-danger" onclick="eliminar(' + i + ');"><i class="material-icons">delete</i></button>' +
            "</td>";
        opciones += "</tr>";
    }
    return opciones
}