$(document).ready(function () {
    const titleModalConfiguracionImpuesto = $("#title-modal-configuracion-impuesto")
    $('#crearConfiguracionImpuesto').on('click', function (e) {
        $("#formConfiguracionImpuesto").validate().resetForm();
        $('input').removeClass('invalid');
        titleModalConfiguracionImpuesto.html('Crear Configuracion Impuesto')
        configuracion_impuesto_id = null;
        $("#nombre_sistema").val('');
        $("#codigo_sistema").val('');
        $("#modalidad").val('');
        $("#ambiente").val('');
        $("#empresa_id").val('');
        $("#estado").val('');
        $("#token_sistema").val('');
    });
});