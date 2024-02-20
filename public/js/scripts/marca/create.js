$(document).ready(function () {
    const titleModalMarca = $("#title-modal-marca")
    $('#crearMarca').on('click', function (e) {
        $("#formMarca").validate().resetForm();
        $('input').removeClass('invalid');
        titleModalMarca.html('Crear Marca')
        marca_id = null
        $("#nombre_marca").val('');
        $("#estado").val('');
    });
});