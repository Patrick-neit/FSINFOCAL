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
    $("#formEmpresa").validate({
        errorLabelContainer: "#messageBox",
        wrapper: "li",
        rules: {
            nombre_empresa: 'required',
            nro_nit_empresa: 'required',
            direccion: 'required',
            telefono: 'required',
            correo: {
                required: true,
                email: true
            },
            logo: 'required',
            representante_legal: 'required',
            estado: 'required'
        },
        errorClass: 'invalid',
        validClass: "valid",
        submitHandler: function (form) {
            const formData = new FormData();
            formData.append("nombre_empresa", nombre_empresa.value);
            formData.append("nro_nit_empresa", nro_nit_empresa.value);
            formData.append("direccion", direccion.value);
            formData.append("telefono", telefono.value);
            formData.append("correo", correo.value);
            formData.append("logo_empresa", logo.files[0]);
            formData.append("representante_legal", representante_legal.value);
            formData.append("estado", estado.value);
            if (empresa_id) {
                formData.append("empresa_id", empresa_id);
            }
            fetch(!empresa_id ? ruta_guardar_empresa : `${ruta_update_empresa}?_method=PUT`, {
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