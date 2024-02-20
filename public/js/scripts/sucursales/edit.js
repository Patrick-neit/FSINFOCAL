$(document).ready(function () {
    const titleModalSucursal = $("#title-modal-sucursal")
    $('tbody').on('click', '#editarSucursal', function (e) {
        $("#formSucursal").validate().resetForm();
        $('input').removeClass('invalid');
        titleModalSucursal.html('Actualizar Sucursal')
        const sucursal = $(this).data('sucursal');
        sucursal_id = sucursal.id;
        ruta_update_sucursal = ruta_update_sucursal.replace('sucursal_id', sucursal_id)
        $("#nombre_sucursal").val(sucursal.nombre_sucursal);
        $("#direccion").val(sucursal.direccion);
        $("#codigo_sucursal").val(sucursal.codigo_sucursal);
        $("#telefono").val(sucursal.telefono);
        $("#empresa_id").val(sucursal.empresa_id);
        $('#modalCrearSucursal').show();
    });
});