$(document).ready(function () {
    const titleModalFamilia = $("#title-modal-familia")
    $('tbody').on('click', '#editarFamilia', function (e) {
        $("#formFamilia").validate().resetForm();
        $('input').removeClass('invalid');
        titleModalFamilia.html('Actualizar Familia')
        const  familia = $(this).data('familia');
        familia_id = familia.id;
        $("#nombre_familia").val(familia.nombre_familia);
        $(`#estado option[value=${familia.estado}]`).prop("selected", 'selected');
        $('#modalCrearFamilia').show();
    });
});