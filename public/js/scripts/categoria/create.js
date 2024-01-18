const csrfToken = document.head.querySelector(
    "[name~=csrf-token][content]"
).content;

let nombre_categoria = document.getElementById("nombre_categoria");
let estado = document.getElementById("estado");

let registrarCategoriaButton = document.getElementById("registrarCategoria");

$(document).ready(function () {
    const registrarCategoriaButton = $("#registrarCategoria")
    const actualizarCategoriaButton = $("#actualizarCategoria")
    const titleModalCategoria = $("#title-modal-Categoria")
    $('#crearCategoria').on('click', function (e) {
        titleModalCategoria.html('Crear Categoria')
        registrarCategoriaButton.removeClass('display-none')
        actualizarCategoriaButton.addClass('display-none')
        $("#nombre_categoria").val('');
        $("#estado").val('');
    });
});

registrarCategoriaButton.addEventListener("click", function (event) {
    event.preventDefault();
    const formData = new FormData();
    formData.append("nombre_categoria", nombre_categoria.value);
    formData.append("estado", estado.value);

    fetch(ruta_guardar_categoria, {
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
                        window.location.href = ruta_index_categoria;
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
