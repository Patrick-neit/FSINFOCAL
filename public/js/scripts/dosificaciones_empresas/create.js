$(document).ready(function () {
    const titleModalDosificacion = $("#title-modal-dosificacion")
    $('#crearDosificacion').on('click', function (e) {
        $("#formDosificacion").validate().resetForm();
        $('input').removeClass('invalid');
        titleModalDosificacion.html('Crear Dosificacion')
        dosificacion_id = null;
        $("#tipo_factura_id").val('');
        $("#documento_sector_id").val('');
        $("#nro_inicio_factura").val('');
        $("#nro_fin_factura").val('');
        $("#empresa_cafc").val('');
    });
});

function storeDosificacion() {
    fetch(ruta_store_dosificacion, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-Token": csrfToken,
        },
        body: JSON.stringify({
            empresa_id: empresa_id.value,
            empresa_cafc: empresa_cafc.value,
            nro_inicio_factura: nro_inicio_factura.value,
            nro_fin_factura: nro_fin_factura.value
        }),

    }).then(response => response.json())
        .then(data => {
            if (data.status == 200) {
                M.toast({
                    html: data.description,
                    classes: 'rounded', displayLength: 2000,
                    completeCallback: function () {
                        window.location.href = ruta_index_dosificacion
                    }
                })
            } else {
                M.toast({
                    html: 'Error!' + data.description,
                    classes: 'rounded', displayLength: 3000, classes: 'blue lighten-1'
                })
            }
        })

}

function handleChangeDSInput() {
    let documento_sector_id = document.getElementById('documento_sector_id');
    let empresa_nombre = document.getElementById('empresa_nombre');
    console.log(empresa_nombre.value)
    let empresa_id = document.getElementById('empresa_id');
    let tipo_factura_id = document.getElementById('tipo_factura_id');
    fetch(ruta_dosificacion_empresa, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-Token": csrfToken,
        },
        body: JSON.stringify({
            empresa_id: empresa_id.value,
            empresa_nombre: empresa_nombre.value,
            documento_sector_id: documento_sector_id.value,
            tipo_factura_id: tipo_factura_id.value
        }),

    }).then(response => response.json())
        .then(data => {
            if (data.status == 200) {
                let opciones = updateDSTable(data.content);
                document.getElementById("tbody").innerHTML = opciones;
            } else {
                M.toast({
                    html: 'Error:' + data.description,
                    classes: 'rounded', displayLength: 3000, classes: 'blue lighten-1'
                })
            }
        })
}

function eliminar(i) {
    fetch(ruta_eliminar_detalle_dosificacion, {
        method: "POST",
        body: JSON.stringify({
            data: i,
        }),
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-Token": csrfToken,
        },
    })
        .then((response) => {
            return response.json();
        })
        .then((data) => {
            let opciones = updateDSTable(data.content);
            document.getElementById("tbody").innerHTML = opciones;
        });
}

function updateDSTable(detalle) {
    let opciones = "";
    for (let i in detalle) {
        console.log(detalle)
        opciones += "<tr>";
        opciones +=
            '<td style="text-align: center;">' +
            detalle[i]["empresa_nombre"] +
            "</td>";
        opciones +=
            '<td style="text-align: center;">' +
            detalle[i]["descripcion_ds"] +
            "</td>";
        opciones +=
            '<td style="text-align: center;">' +
            detalle[i]["tipo_factura_ds"] +
            "</td>";
        opciones +=
            '<td style="text-align: center;">' +
            '<button type="button" class="btn btn-danger" onclick="eliminar(' + i + ');"><i class="material-icons">delete</i></button>' +
            "</td>";
        opciones += "</tr>";
    }
    return opciones
}



