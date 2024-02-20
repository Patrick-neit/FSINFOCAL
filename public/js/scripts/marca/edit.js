$(document).ready(function () {
    const titleModalMarca = $("#title-modal-marca")
    $('tbody').on('click', '#editarMarca', function (e) {
        $("#formMarca").validate().resetForm();
        $('input').removeClass('invalid');
        const marca = $(this).data('marca');
        titleModalMarca.html('Actualizar Marca')
        marca_id = marca.id;
        ruta_update_marca = ruta_update_marca.replace('marca_id', marca.id)
        $("#nombre_marca").val(marca.nombre_marca);
        $(`#estado option[value=${marca.estado}]`).prop("selected", 'selected');
        $('#modalCrearMarca').show();
    });
});