const csrfToken = document.head.querySelector(
    "[name~=csrf-token][content]"
).content;

let nombre_empresa = document.getElementById("nombre_empresa");
let nro_nit_empresa = document.getElementById("nro_nit_empresa");
let direccion = document.getElementById("direccion");
let telefono = document.getElementById("telefono");
let correo = document.getElementById("correo");
let logo = document.getElementById("logo");
let representante_legal = document.getElementById("representante_legal");
let estado = document.getElementById("estado");

let registrarEmpresaButton = document.getElementById("registrarEmpresa");

$(document).ready(function () {
    const registrarEmpresaButton = $("#registrarEmpresa")
    const actualizarEmpresaButton = $("#actualizarEmpresa")
    const titleModalEmpresa = $("#title-modal-empresa")
    $('#crearEmpresa').on('click', function (e) {
        titleModalEmpresa.html('Crear Empresa')
        registrarEmpresaButton.removeClass('display-none')
        actualizarEmpresaButton.addClass('display-none')
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

registrarEmpresaButton.addEventListener("click", function (event) {
    event.preventDefault();
    const formData = new FormData();
    formData.append("nombre_empresa", nombre_empresa.value);
    formData.append("nro_nit_empresa", nro_nit_empresa.value);
    formData.append("direccion", direccion.value);
    formData.append("telefono", telefono.value);
    formData.append("correo", correo.value);
    formData.append("representante_legal", representante_legal.value);
    formData.append("logo_empresa", logo.files[0]);
    formData.append("estado", estado.value);

    fetch(ruta_guardar_empresa, {
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
                    html: "Registrado con Exito!",
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
});
