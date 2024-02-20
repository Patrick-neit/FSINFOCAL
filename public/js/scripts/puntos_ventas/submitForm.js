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
    $("#formPuntoVenta").validate({
        errorLabelContainer: "#messageBox",
        wrapper: "li",
        rules: {
            nombre_punto_venta: 'required',
            descripcion_punto_venta: 'required',
            tipo_punto_venta: 'required',
            sucursal_id: 'required',
        },
        errorClass: 'invalid',
        validClass: "valid",
        submitHandler: function (form) {
            const formData = new FormData();
            formData.append("nombre_punto_venta", nombre_punto_venta.value);
            formData.append("descripcion_punto_venta", descripcion_punto_venta.value);
            formData.append("tipo_punto_venta", tipo_punto_venta.value);
            formData.append("sucursal_id", sucursal_id.value);
            if (punto_venta_id) {
                formData.append("punto_venta_id", punto_venta_id);
            }
            fetch(!punto_venta_id ? ruta_guardar_punto_venta : `${ruta_update_punto_venta}?_method=PUT`, {
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