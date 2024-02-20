$(document).ready(function () {
    const titleModalSucursal = $("#title-modal-sucursal")
    $('#crearSucursal').on('click', function (e) {
        $("#formSucursal").validate().resetForm();
        $('input').removeClass('invalid');
        titleModalSucursal.html('Crear Sucursal')
        sucursal_id = null;
        $("#nombre_sucursal").val('');
        $("#direccion").val('');
        $("#codigo_sucursal").val('');
        $("#telefono").val('');
        $("#empresa_id").val('');
    });
});