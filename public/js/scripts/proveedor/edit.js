$(document).ready(function () {
    const titleModalProveedor = $("#title-modal-proveedor")
    $('tbody').on('click', '#editarProveedor', function (e) {
        $("#formProveedor").validate().resetForm();
        $('input').removeClass('invalid');
        const proveedor = $(this).data('proveedor');
        titleModalProveedor.html('Actualizar Proveedor')
        proveedor_id = proveedor.id;
        nombre_proveedor.value = proveedor.nombre_proveedor
        direccion.value = proveedor.direccion
        telefono.value = proveedor.telefono
        rubro.value = proveedor.rubro
        documentoIdentidad.value = proveedor.tipo_documento
        numero_documento.value = proveedor.numero_documento
        correo.value = proveedor.correo
        contacto.value = proveedor.contacto
        estado.value = proveedor.estado
        sucursal_id.value = proveedor.sucursal_id
        $('#modalCrearProveedor').show();
    });
});