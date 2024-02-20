
$(document).ready(function () {
    const titleModalFamilia = $("#title-modal-Familia")
    $('#crearFamilia').on('click', function (e) {
        $("#formFamilia").validate().resetForm();
        $('input').removeClass('invalid');
        titleModalFamilia.html('Crear Familia')
        familia_id = null;
        $("#nombre_familia").val('');
        $("#estado").val('');
    });
});