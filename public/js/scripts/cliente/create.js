$(document).ready(function () {
    const registrarClienteButton = $("#registrarCliente")
    const actualizarClienteButton = $("#actualizarCliente")
    const titleModalCliente = $("#title-modal-cliente")
    $('#crearCliente').on('click', function (e) {
        $("#formCliente").validate().resetForm();
        $('input').removeClass('invalid');
        titleModalCliente.html('Crear Cliente')
        registrarClienteButton.removeClass('display-none')
        actualizarClienteButton.addClass('display-none')
        cliente_id = null;
        nombre_cliente.value = ''
        documento.value = ''
        numero_nit.value = ''
        complemento.value = ''
        direccion.value = ''
        telefono.value = ''
        correo.value = ''
        departamento_id.value = ''
        fecha_cumpleanos.value = ''
        contacto.value = ''
        tipos_precios.value = ''
        estado.value = ''
    });
});
