$(document).ready(function () {
    $('select').formSelect()
    const registrarUserButton = $("#registrarUser")
    const actualizarUserButton = $("#actualizarUser")
    const titleModalUser = $("#title-modal-user")

    let user_id = null;
    $('tbody').on('click', '#editarUser', function (e) {
        const user = $(this).data('user');

        titleModalUser.html('Actualizar Usuario')
        actualizarUserButton.removeClass('display-none')
        registrarUserButton.addClass('display-none')
        user_id = user.id;

        $("#nombres").val(user.name);
        $("#apellidos").val(user.apellidos);
        $("#fecha_nacimiento").val(user.fecha_nacimiento);
        $("#ci").val(user.ci);
        $("#email").val(user.email);
        $("#departamento_id").val(user.departamento_id).change();
        $('#modalCrearUsuario').show();
    });

    $('#actualizarUser').on('click', function (e) {
        e.preventDefault();
        const formData = new FormData();
        formData.append("name", nombres.value);
        formData.append("apellido", apellidos.value);
        formData.append("ci", ci.value);
        formData.append("fecha_nacimiento", fecha_nacimiento.value);
        formData.append("email", email.value);
        formData.append("password", password.value);
        formData.append("avatar", avatar.files[0]);
        formData.append("user_id", user_id);
        formData.append("departamento_id", departamento_id.value);

        fetch(ruta_update_user, {
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
                        html: "Actualizado con Exito!",
                        classes: "rounded",
                        displayLength: 3000,
                        completeCallback: function () {
                            window.location.href = ruta_index_user;
                        },
                    });
                } else {
                    M.toast({
                        html: "Algo salio Mal!",
                        classes: "rounded",
                        displayLength: 3000,
                        classes: "blue lighten-1",
                    });
                }
            })
            .catch((error) => {
                console.log(error);
            });
    })
});