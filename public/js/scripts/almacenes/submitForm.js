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
    $("#formAlmacen").validate({
        errorLabelContainer: "#messageBox",
        wrapper: "li",
        rules: {
            nombre: 'required',
            capacidad_almacen: 'required',
            encargado_id: 'required',
            sucursal_id: 'required',
        },
        errorClass: 'invalid',
        validClass: "valid",
        submitHandler: function (form) {
            const formData = new FormData();
            formData.append("nombre_almacen", nombre.value);
            formData.append("capacidad_almacen", capacidad_almacen.value);
            formData.append("encargado_id", encargado_id.value);
            formData.append("sucursal_id", sucursal_id.value);
            if (almacen_id) {
                formData.append("almacen_id", almacen_id);
            }
            fetch(!almacen_id ? ruta_guardar_almacen : `${ruta_update_almacen}`, {
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