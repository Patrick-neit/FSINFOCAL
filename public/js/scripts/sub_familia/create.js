const csrfToken = document.head.querySelector(
    "[name~=csrf-token][content]"
).content;

let nombre_familia = document.getElementById("nombre_sub_familia");
let familia_id = document.getElementById("familia_id");
let estado = document.getElementById("estado");

let registrarSubFamiliaButton = document.getElementById("registrarSubFamilia");

$(document).ready(function () {
    const registrarSubFamiliaButton = $("#registrarSubFamilia")
    const actualizarSubFamiliaButton = $("#actualizarSubFamilia")
    const titleModalSubFamilia = $("#title-modal-SubFamilia")
    $('#crearSubFamilia').on('click', function (e) {
        titleModalSubFamilia.html('Crear Sub Familia')
        registrarSubFamiliaButton.removeClass('display-none')
        actualizarSubFamiliaButton.addClass('display-none')
        $("#nombre_sub_familia").val('');
        $("#familia_id").val('');
        $("#estado").val('');
    });
});

registrarSubFamiliaButton.addEventListener("click", function (event) {
    event.preventDefault();
    const formData = new FormData();
    formData.append("nombre_sub_familia", nombre_sub_familia.value);
    formData.append("familia_id", familia_id.value);
    formData.append("estado", estado.value);

    fetch(ruta_guardar_sub_familia, {
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
                        window.location.href = ruta_index_sub_familia;
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
