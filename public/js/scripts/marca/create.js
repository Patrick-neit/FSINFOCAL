const csrfToken = document.head.querySelector(
    "[name~=csrf-token][content]"
).content;

let nombre_marca = document.getElementById("nombre_marca");
let estado = document.getElementById("estado");

let registrarMarcaButton = document.getElementById("registrarMarca");

$(document).ready(function () {
    const registrarMarcaButton = $("#registrarMarca")
    const actualizarMarcaButton = $("#actualizarMarca")
    const titleModalMarca = $("#title-modal-marca")
    $('#crearMarca').on('click', function (e) {
        titleModalMarca.html('Crear Marca')
        registrarMarcaButton.removeClass('display-none')
        actualizarMarcaButton.addClass('display-none')
        $("#nombre_marca").val('');
        $("#estado").val('');
    });
});

registrarMarcaButton.addEventListener("click", function (event) {
    event.preventDefault();
    const formData = new FormData();
    formData.append("nombre_marca", nombre_marca.value);
    formData.append("estado", estado.value);

    fetch(ruta_guardar_marca, {
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
                        window.location.href = ruta_index_marca;
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
