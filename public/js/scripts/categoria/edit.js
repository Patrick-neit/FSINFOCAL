$(document).ready(function () {
    const titleModalCategoria = $("#title-modal-categoria")
    $('tbody').on('click', '#editarCategoria', function (e) {
        $("#formCategoria").validate().resetForm();
        $('input').removeClass('invalid');
        const categoria = $(this).data('categoria');
        titleModalCategoria.html('Actualizar Categoria')
        categoria_id = categoria.id;
        $("#nombre_categoria").val(categoria.nombre_categoria);
        $(`#estado option[value=${categoria.estado}]`).prop("selected", 'selected');
        $('#modalCrearCategoria').show();
    });
});