$(document).ready(function () {
    $('select').formSelect()
    const registrarSubFamiliaButton = $("#registrarSubFamilia")
    const actualizarSubFamiliaButton = $("#actualizarSubFamilia")
    const titleModalSubFamilia = $("#title-modal-sub-familia")


    let sub_familia_id = null;
    $('tbody').on('click', '#editarSubFamilia', function (e) {
        const sub_familia = $(this).data('sub_familia');

        titleModalSubFamilia.html('Actualizar SubFamilia')
        actualizarSubFamiliaButton.removeClass('display-none')
        registrarSubFamiliaButton.addClass('display-none')
        sub_familia_id = sub_familia.id;

        $("#nombre_sub_familia").val(sub_familia.nombre_sub_familia);
        $(`#familia_id`).val(sub_familia.familia_id).change();
        $("#estado").val(sub_familia.estado).change();
        $('#modalCrearSubFamilia').show();
    });

    $('#actualizarSubFamilia').on('click', function (e) {
        e.preventDefault();
        const formData = new FormData();
        formData.append("nombre_sub_familia", nombre_sub_familia.value);
        formData.append("estado", estado.value);
        formData.append("familia_id", familia_id.value);
        formData.append("sub_familia_id", sub_familia_id);

        fetch(ruta_update_sub_familia, {
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
    })
});