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
    $("#formCliente").validate({
        errorLabelContainer: "#messageBox",
        wrapper: "li",
        rules: {
            nombre_cliente: 'required',
            documento: 'required',
            numero_nit: 'required',
            complemento: 'required',
            direccion: 'required',
            telefono: 'required',
            correo: {
                required: true,
                email: true,
            },
            departamento_id: 'required',
            fecha_cumpleanos: 'required',
            contacto: 'required',
            tipos_precios: 'required',
            estado: 'required',
        },
        errorClass: 'invalid',
        validClass: "valid",
        submitHandler: function (form) {
            fetch(!cliente_id ? ruta_guardar_cliente : `${ruta_update_cliente}`, {
                method: "POST",
                headers: {
                    "X-CSRF-Token": csrfToken,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    nombre_cliente: nombre_cliente.value,
                    documento: documento.value,
                    numero_nit: numero_nit.value,
                    complemento: complemento.value,
                    direccion: direccion.value,
                    telefono: telefono.value,
                    correo: correo.value,
                    departamento_id: departamento_id.value,
                    fecha_cumpleanos: fecha_cumpleanos.value,
                    contacto: contacto.value,
                    tipos_precios: tipos_precios.value,
                    estado: estado.value,
                    cliente_id: cliente_id,
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