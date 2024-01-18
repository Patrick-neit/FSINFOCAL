const csrfToken = document.head.querySelector(
    "[name~=csrf-token][content]"
).content;

let nombre_familia = document.getElementById("nombre_familia");
let estado = document.getElementById("estado");

let registrarFamiliaButton = document.getElementById("registrarFamilia");

$(document).ready(function () {
    const registrarFamiliaButton = $("#registrarFamilia")
    const actualizarFamiliaButton = $("#actualizarFamilia")
    const titleModalFamilia = $("#title-modal-Familia")
    $('#crearFamilia').on('click', function (e) {
        titleModalFamilia.html('Crear Familia')
        registrarFamiliaButton.removeClass('display-none')
        actualizarFamiliaButton.addClass('display-none')
        $("#nombre_familia").val('');
        $("#estado").val('');
    });
});

registrarFamiliaButton.addEventListener("click", function (event) {
    event.preventDefault();
    const formData = new FormData();
    formData.append("nombre_familia", nombre_familia.value);
    formData.append("estado", estado.value);

    fetch(ruta_guardar_familia, {
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
                        window.location.href = ruta_index_familia;
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
