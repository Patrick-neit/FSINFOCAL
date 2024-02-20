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
    $("#formSubFamilia").validate({
        errorLabelContainer: "#messageBox",
        wrapper: "li",
        rules: {
            nombre_sub_familia: 'required',
            familia_id: 'required',
            estado: 'required',
        },
        errorClass: 'invalid',
        validClass: "valid",
        submitHandler: function (form) {
            const formData = new FormData();
            formData.append("nombre_sub_familia", nombre_sub_familia.value);
            formData.append("familia_id", familia_id.value);
            formData.append("estado", estado.value);
            if (sub_familia_id) {
                formData.append("sub_familia_id", sub_familia_id);
            }
            fetch(!sub_familia_id ? ruta_guardar_sub_familia : `${ruta_update_sub_familia}`, {
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