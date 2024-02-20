$(document).ready(function () {
    const titleModalPuntoVenta = $("#title-modal-punto-venta")
    $('tbody').on('click', '#editarPuntoVenta', function (e) {
        $("#formPuntoVenta").validate().resetForm();
        $('input').removeClass('invalid');
        const punto_venta = $(this).data('punto_venta');
        titleModalPuntoVenta.html('Actualizar PuntoVenta')
        punto_venta_id = punto_venta.id;
        ruta_update_punto_venta = ruta_update_punto_venta.replace('punto_venta_id', punto_venta_id)
        $("#nombre_punto_venta").val(punto_venta.nombre_punto_venta);
        $("#descripcion_punto_venta").val(punto_venta.descripcion_punto_venta);
        $("#tipo_punto_venta").val(punto_venta.tipo_punto_venta);
        $("#sucursal_id").val(punto_venta.sucursal_id);
        $('#modalCrearEmpresa').show();
    });
});