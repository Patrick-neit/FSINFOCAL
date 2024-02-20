$(document).ready(function () {
    const titleModalEmpresa = $("#title-modal-empresa")
    $('#crearEmpresa').on('click', function (e) {
        $("#formEmpresa").validate().resetForm();
        $('input').removeClass('invalid');
        empresa_id = null
        titleModalEmpresa.html('Crear Empresa')
        $("#nombre_empresa").val('');
        $("#nro_nit_empresa").val('');
        $("#direccion").val('');
        $("#telefono").val('');
        $("#correo").val('');
        $("#logo").val('');
        $("#representante_legal").val('');
        $("#estado").val('');
    });
});
