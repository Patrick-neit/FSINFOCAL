$(document).ready(function () {
    const titleModalCliente = $("#title-modal-cliente")
    $('tbody').on('click', '#editarCliente', function (e) {
        $("#formCliente").validate().resetForm();
        $('input').removeClass('invalid');
        const cliente = $(this).data('cliente');
        titleModalCliente.html('Actualizar Cliente')
        cliente_id = cliente.id;
        nombre_cliente.value = cliente.nombre_cliente
        documento.value = cliente.documento
        numero_nit.value = cliente.numero_nit
        complemento.value = cliente.complemento
        direccion.value = cliente.direccion
        telefono.value = cliente.telefono
        correo.value = cliente.correo
        departamento_id.value = cliente.departamento_id
        fecha_cumpleanos.value = cliente.fecha_cumpleanos
        contacto.value = cliente.contacto
        tipos_precios.value = cliente.tipos_precios
        estado.value = cliente.estado
        $('#modalCrearCliente').show();
    });
});