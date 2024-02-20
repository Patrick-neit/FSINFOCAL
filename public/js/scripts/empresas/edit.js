$(document).ready(function () {
    const titleModalEmpresa = $("#title-modal-empresa")
    $('tbody').on('click', '#editarEmpresa', function (e) {
        $("#formEmpresa").validate().resetForm();
        $('input').removeClass('invalid');
        const empresa = $(this).data('empresa');
        titleModalEmpresa.html('Actualizar Empresa')
        console.log(empresa)
        empresa_id = empresa.id;
        ruta_update_empresa = ruta_update_empresa.replace('empresa_id', empresa_id)
        $("#nombre_empresa").val(empresa.nombre_empresa);
        $("#nro_nit_empresa").val(empresa.nro_nit_empresa);
        $("#direccion").val(empresa.direccion);
        $("#telefono").val(empresa.telefono);
        $("#correo").val(empresa.correo);
        $("#representante_legal").val(empresa.representante_legal);
        $("#estado").val(empresa.estado);
        $('#modalCrearEmpresa').show();
    });
});