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
    $("#formSucursal").validate({
        errorLabelContainer: "#messageBox",
        wrapper: "li",
        rules: {
            nombre_sucursal: 'required',
            direccion: 'required',
            codigo_sucursal: 'required',
            telefono: 'required',
            empresa_id: 'required',
        },
        errorClass: 'invalid',
        validClass: "valid",
        submitHandler: function (form) {
            const formData = new FormData();
            formData.append("nombre_sucursal", nombre_sucursal.value);
            formData.append("direccion", direccion.value);
            formData.append("codigo_sucursal", codigo_sucursal.value);
            formData.append("telefono", telefono.value);
            formData.append("empresa_id", empresa_id.value);
            if (sucursal_id) {
                formData.append("sucursal_id", sucursal_id);
            }
            fetch(!sucursal_id ? ruta_guardar_sucursal : `${ruta_update_sucursal}?_method=PUT`, {
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
                        classes: "rounded",
                        displayLength: 3000,
                    });
                });
        }
    });
})