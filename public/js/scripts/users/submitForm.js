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
    $("#formUser").validate({
        errorLabelContainer: "#messageBox",
        wrapper: "li",
        rules: {
            nombres: 'required',
            apellidos: 'required',
            ci: 'required',
            fecha_nacimiento: 'required',
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 6
            },
            departamento_id: {
                required: true,
            },
            avatar: 'required'
        },
        errorClass: 'invalid',
        validClass: "valid",
        submitHandler: function (form) {
            const formData = new FormData();
            formData.append("name", nombres.value);
            formData.append("apellido", apellidos.value);
            formData.append("ci", ci.value);
            formData.append("fecha_nacimiento", fecha_nacimiento.value);
            formData.append("email", email.value);
            formData.append("password", password.value);
            formData.append("avatar", avatar.files[0]);
            formData.append("departamento_id", departamento_id.value);
            if (user_id) {
                formData.append("user_id", user_id);
            }
            fetch(!user_id ? ruta_guardar_user : ruta_update_user, {
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
                });
        }
    });
})