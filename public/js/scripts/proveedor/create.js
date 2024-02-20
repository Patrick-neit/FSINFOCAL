$(document).ready(function () {
    const titleModalProveedor = $("#title-modal-proveedor")
    $('#crearProveedor').on('click', function (e) {
        $("#formProveedor").validate().resetForm();
        $('input').removeClass('invalid');
        titleModalProveedor.html('Crear Proveedor')
        proveedor_id = null;
        nombre_proveedor.value = ''
        direccion.value = ''
        telefono.value = ''
        rubro.value = ''
        documentoIdentidad.value = ''
        numero_documento.value = ''
        correo.value = ''
        contacto.value = ''
        estado.value = ''
        sucursal_id.value = ''
    });
});