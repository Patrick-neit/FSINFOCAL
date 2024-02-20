$(document).ready(function () {
    const titleModalSubFamilia = $("#title-modal-SubFamilia")
    $('#crearSubFamilia').on('click', function (e) {
        $("#formSubFamilia").validate().resetForm();
        $('input').removeClass('invalid');
        titleModalSubFamilia.html('Crear Sub Familia')
        sub_familia_id = null;
        $("#nombre_sub_familia").val('');
        $("#familia_id").val('');
        $("#estado").val('');
    });
});