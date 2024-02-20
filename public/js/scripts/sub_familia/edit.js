$(document).ready(function () {
    const titleModalSubFamilia = $("#title-modal-sub-familia")
    $('tbody').on('click', '#editarSubFamilia', function (e) {
        $("#formSubFamilia").validate().resetForm();
        $('input').removeClass('invalid');
        const sub_familia = $(this).data('sub_familia');
        titleModalSubFamilia.html('Actualizar SubFamilia')
        sub_familia_id = sub_familia.id;
        $("#nombre_sub_familia").val(sub_familia.nombre_sub_familia);
        $(`#familia_id`).val(sub_familia.familia_id).change();
        $("#estado").val(sub_familia.estado).change();
        $('#modalCrearSubFamilia').show();
    });
  
});