$(document).ready(function () {
    $('select[required]').css({
        display: 'inline',
        position: 'absolute',
        float: 'left',
        padding: 0,
        margin: 0,
        border: '1px solid rgba(255,255,255,0)',
        height: 0,
        width: 0,
        top: '2em',
        left: '3em'
    });
    $("#formProveedor").validate({
        errorLabelContainer: "#messageBox",
        wrapper: "li",
        rules: {
            nombre_proveedor: 'required',
            direccion: 'required',
            telefono: 'required',
            rubro: 'required',
            documentoIdentidad: 'required',
            numero_documento: 'required',
            correo: {
                required: true,
                email: true,
            },
            contacto: 'required',
            estado: 'required',
            sucursal_id: 'required',
        },
        errorClass: 'invalid',
        validClass: "valid",
        submitHandler: function (form) {
            fetch(!proveedor_id ? ruta_guardar_proveedor : `${ruta_update_proveedor}`, {
                method: "POST",
                headers: {
                    "X-CSRF-Token": csrfToken,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    nombre_proveedor: nombre_proveedor.value,
                    direccion: direccion.value,
                    telefono: telefono.value,
                    rubro: rubro.value,
                    documentoIdentidad: documentoIdentidad.value,
                    numero_documento: numero_documento.value,
                    correo: correo.value,
                    contacto: contacto.value,
                    estado: estado.value,
                    sucursal_id: sucursal_id.value,
                    proveedor_id: proveedor_id,
                }),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.status == 200) {
                        M.toast({
                            html: "Guardado Exitosamente!",
                            classes: "rounded",
                            displayLength: 3000,
                            completeCallback: function () {
                                window.location.href = ruta_index;
                            },
                        });
                    } else {
                        M.toast({
                            html: "Algo salió Mal!",
                            classes: "rounded blue lighten-1",
                            displayLength: 3000,
                        });
                    }
                })
                .catch((error) => {
                    console.log(error);
                    M.toast({
                        html: "Algo salió Mal!",
                        classes: "rounded blue lighten-1",
                        displayLength: 3000,
                    });
                });
        }
    });
})