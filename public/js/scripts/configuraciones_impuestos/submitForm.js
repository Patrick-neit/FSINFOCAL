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
    $("#formConfiguracionImpuesto").validate({
        errorLabelContainer: "#messageBox",
        wrapper: "li",
        rules: {
            nombre_sistema: 'required',
            codigo_sistema: 'required',
            modalidad: 'required',
            ambiente: 'required',
            empresa_id: 'required',
            estado: 'required',
            token_sistema: 'required',
        },
        errorClass: 'invalid',
        validClass: "valid",
        submitHandler: function (form) {
            const formData = new FormData();
            formData.append("nombre_sistema", nombre_sistema.value);
            formData.append("codigo_sistema", codigo_sistema.value);
            formData.append("modalidad", modalidad.value);
            formData.append("ambiente", ambiente.value);
            formData.append("empresa_id", empresa_id[0].value);
            formData.append("estado", estado.value);
            formData.append("token_sistema", token_sistema.value);
            if (configuracion_impuesto_id) {
                formData.append("configuracion_impuesto_id", configuracion_impuesto_id);
            }
            fetch(!configuracion_impuesto_id ? ruta_guardar_configuracion_impuesto : `${ruta_update_configuracion_impuesto}?_method=PUT`, {
                method: "POST",
                headers: {
                    "X-CSRF-Token": csrfToken,
                },
                body: formData,
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