$(document).ready(function () {
    $('select').formSelect()
    const registrarMarcaButton = $("#registrarMarca")
    const actualizarMarcaButton = $("#actualizarMarca")
    const titleModalMarca = $("#title-modal-marca")


    let marca_id = null;
    $('tbody').on('click', '#editarMarca', function (e) {
        const marca = $(this).data('marca');

        titleModalMarca.html('Actualizar Marca')
        actualizarMarcaButton.removeClass('display-none')
        registrarMarcaButton.addClass('display-none')
        marca_id = marca.id;
        ruta_update_marca = ruta_update_marca.replace('marca_id', marca.id)
        $("#nombre_marca").val(marca.nombre_marca);
        $(`#estado option[value=${marca.estado}]`).prop("selected", 'selected');
        $('#modalCrearMarca').show();
    });

    $('#actualizarMarca').on('click', function (e) {
        e.preventDefault();
        const formData = new FormData();
        formData.append("nombre_marca", nombre_marca.value);
        formData.append("estado", estado.value);
        formData.append("marca_id", marca_id);

        fetch(`${ruta_update_marca}?_method=PUT`, {
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
    })
});