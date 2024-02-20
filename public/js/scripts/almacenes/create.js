$(document).ready(function () {
    const titleModalAlmacen = $("#title-modal-almacen")
    $('#crearAlmacen').on('click', function (e) {
        $("#formAlmacen").validate().resetForm();
        $('input').removeClass('invalid');
        titleModalAlmacen.html('Crear Almacen')
        almacen_id = null;
        $("#nombre").val('');
        $("#capacidad_almacen").val('');
        $("#encargado_id").val('');
        $("#sucursal_id").val('');
    });
});