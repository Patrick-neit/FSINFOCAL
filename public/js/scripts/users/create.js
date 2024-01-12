const csrfToken = document.head.querySelector(
    "[name~=csrf-token][content]"
).content;

$(document).ready(function () {
    const registrarUserButton = $("#registrarUser")
    const actualizarUserButton = $("#actualizarUser")
    const titleModalUser = $("#title-modal-user")
    $('#crearUser').on('click', function (e) {
        titleModalUser.html('Crear Usuario')
        registrarUserButton.removeClass('display-none')
        actualizarUserButton.addClass('display-none')
        $("#nombres").val('');
        $("#apellidos").val('');
        $("#fecha_nacimiento").val('');
        $("#ci").val('');
        $("#email").val('');
    });
});

let nombres = document.getElementById("nombres");
let apellidos = document.getElementById("apellidos");
let ci = document.getElementById("ci");
let fecha_nacimiento = document.getElementById("fecha_nacimiento");
let email = document.getElementById("email");
let password = document.getElementById("password");
let avatar = document.getElementById("avatar");

let registrarUserButton = document.getElementById("registrarUser");

registrarUserButton.addEventListener("click", function (event) {
    event.preventDefault();
    const formData = new FormData();
    formData.append("name", nombres.value);
    formData.append("apellido", apellidos.value);
    formData.append("ci", ci.value);
    formData.append("fecha_nacimiento", fecha_nacimiento.value);
    formData.append("email", email.value);
    formData.append("password", password.value);
    formData.append("avatar", avatar.files[0]);
    formData.append("estado", 1);

    fetch(ruta_guardar_user, {
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
                    html: "Registrado con Exito!",
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
});
