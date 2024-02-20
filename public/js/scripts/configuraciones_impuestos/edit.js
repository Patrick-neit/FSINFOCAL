$(document).ready(function () {
    const titleModalConfiguracionImpuesto = $("#title-modal-configuracion-impuesto")
    $('tbody').on('click', '#editarConfiguracionImpuesto', function (e) {
        $("#formConfiguracionImpuesto").validate().resetForm();
        $('input').removeClass('invalid');
        const configuracion_impuesto = $(this).data('configuracion_impuesto');
        titleModalConfiguracionImpuesto.html('Actualizar Configuracion Impuesto')
        configuracion_impuesto_id = configuracion_impuesto.id;
        ruta_update_configuracion_impuesto = ruta_update_configuracion_impuesto.replace('configuracion_impuesto_id', configuracion_impuesto_id)
        $("#nombre_sistema").val(configuracion_impuesto.nombre_sistema);
        $("#codigo_sistema").val(configuracion_impuesto.codigo_sistema);
        $("#modalidad").val(configuracion_impuesto.modalidad);
        $("#ambiente").val(configuracion_impuesto.ambiente);
        $("#estado").val(configuracion_impuesto.estado);
        $("#token_sistema").val(configuracion_impuesto.token_sistema);
        $('#modalCrearEmpresa').show();
    });
});