$(document).ready(function () {
    const titleModalAlmacen = $("#title-modal-almacen")
    $('tbody').on('click', '#editarAlmacen', function (e) {
        $("#formAlmacen").validate().resetForm();
        $('input').removeClass('invalid');
        const almacen = $(this).data('almacen');
        titleModalAlmacen.html('Actualizar Almacen')
        almacen_id = almacen.id;
        // ruta_update_almacen = ruta_update_almacen.replace('almacen_id', almacen_id)
        $("#nombre").val(almacen.nombre);
        $("#capacidad_almacen").val(almacen.capacidad_almacen);
        $("#encargado_id").val(almacen.encargado_id);
        $("#sucursal_id").val(almacen.sucursal_id);
        $('#modalCrearAlmacen').show();
    });
});