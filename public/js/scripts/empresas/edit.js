$(document).ready(function () {
    $('select').formSelect()
    const registrarEmpresaButton = $("#registrarEmpresa")
    const actualizarEmpresaButton = $("#actualizarEmpresa")
    const titleModalEmpresa = $("#title-modal-empresa")

    let empresa_id = null;
    $('tbody').on('click', '#editarEmpresa', function (e) {
        const empresa = $(this).data('empresa');

        titleModalEmpresa.html('Actualizar Empresa')
        actualizarEmpresaButton.removeClass('display-none')
        registrarEmpresaButton.addClass('display-none')
        empresa_id = empresa.id;

        $("#nombre_empresa").val(empresa.nombre_empresa);
        $("#nro_nit_empresa").val(empresa.nro_nit_empresa);
        $("#direccion").val(empresa.direccion);
        $("#telefono").val(empresa.telefono);
        $("#correo").val(empresa.correo);
        $("#logo").val(empresa.logo);
        $("#representante_legal").val(empresa.representante_legal);
        $("#estado").val(empresa.estado);
        $('#modalCrearEmpresa').show();
    });

    $('#actualizarEmpresa').on('click', function (e) {
        e.preventDefault();
        const formData = new FormData();
        formData.append("nombre_empresa", nombre_empresa.value);
        formData.append("nro_nit_empresa", nro_nit_empresa.value);
        formData.append("direccion", direccion.value);
        formData.append("fecha_nacimiento", fecha_nacimiento.value);
        formData.append("correo", correo.value);
        formData.append("logo", logo.files[0]);
        formData.append("representante_legal", representante_legal.value);
        formData.append("estado", estado.value);

        fetch(ruta_update_empresa, {
            method: "POST",
            headers: {
                "X-CSRF-Token": csrfToken,
            },
            body: formData,
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.status == 200) {
                    M.toast({
                        html: "Actualizado con Exito!",
                        classes: "rounded",
                        displayLength: 3000,
                        completeCallback: function () {
                            window.location.href = ruta_index_empresa;
                        },
                    });
                } else {
                    M.toast({
                        html: "Algo salio Mal!",
                        classes: "rounded",
                        displayLength: 3000,
                        classes: "blue lighten-1",
                    });
                }
            })
            .catch((error) => {
                console.log(error);
            });
    })
});