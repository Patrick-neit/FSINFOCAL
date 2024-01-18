$(document).ready(function () {
    $('select').formSelect()
    const registrarFamiliaButton = $("#registrarFamilia")
    const actualizarFamiliaButton = $("#actualizarFamilia")
    const titleModalFamilia = $("#title-modal-familia")


    let familia_id = null;
    $('tbody').on('click', '#editarFamilia', function (e) {
        const familia = $(this).data('familia');

        titleModalFamilia.html('Actualizar Familia')
        actualizarFamiliaButton.removeClass('display-none')
        registrarFamiliaButton.addClass('display-none')
        familia_id = familia.id;

        $("#nombre_familia").val(familia.nombre_familia);
        $(`#estado option[value=${familia.estado}]`).prop("selected", 'selected');
        $('#modalCrearFamilia').show();
    });

    $('#actualizarFamilia').on('click', function (e) {
        e.preventDefault();
        const formData = new FormData();
        formData.append("nombre_familia", nombre_familia.value);
        formData.append("estado", estado.value);
        formData.append("familia_id", familia_id);

        fetch(ruta_update_familia, {
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
    })
});