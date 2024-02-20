$(document).ready(function () {
    const titleModalCategoria = $("#title-modal-Categoria")
    $('#crearCategoria').on('click', function (e) {
        $("#formCategoria").validate().resetForm();
        $('input').removeClass('invalid');
        titleModalCategoria.html('Crear Categoria')
        $("#nombre_categoria").val('');
        $("#estado").val('');
    });
});