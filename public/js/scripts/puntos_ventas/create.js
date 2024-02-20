$(document).ready(function () {
    const titleModalPuntoVenta = $("#title-modal-punto-venta")
    $('#crearPuntoVenta').on('click', function (e) {
        $("#formPuntoVenta").validate().resetForm();
        $('input').removeClass('invalid');
        titleModalPuntoVenta.html('Crear Punto de Venta')
        punto_venta_id = null;
        $("#nombre_punto_venta").val('');
        $("#descripcion_punto_venta").val('');
        $("#tipo_punto_venta").val('');
        $("#sucursal_id").val('');
    });
});