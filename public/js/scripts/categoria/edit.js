$(document).ready(function () {
    $('select').formSelect()
    const registrarCategoriaButton = $("#registrarCategoria")
    const actualizarCategoriaButton = $("#actualizarCategoria")
    const titleModalCategoria = $("#title-modal-categoria")


    let categoria_id = null;
    $('tbody').on('click', '#editarCategoria', function (e) {
        const categoria = $(this).data('categoria');

        titleModalCategoria.html('Actualizar Categoria')
        actualizarCategoriaButton.removeClass('display-none')
        registrarCategoriaButton.addClass('display-none')
        categoria_id = categoria.id;

        $("#nombre_categoria").val(categoria.nombre_categoria);
        $(`#estado option[value=${categoria.estado}]`).prop("selected", 'selected');
        $('#modalCrearCategoria').show();
    });

    $('#actualizarCategoria').on('click', function (e) {
        e.preventDefault();
        const formData = new FormData();
        formData.append("nombre_categoria", nombre_categoria.value);
        formData.append("estado", estado.value);
        formData.append("categoria_id", categoria_id);

        fetch(ruta_update_categoria, {
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
    })
});