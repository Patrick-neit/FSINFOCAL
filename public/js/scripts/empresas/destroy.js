$(document).ready(function () {
    let empresa_id = null;
    $('tbody').on('click', '#eliminarEmpresa', function (e) {
        empresa_id = $(this).data('id');
    });

    $('#confirmEliminar').on('click', function (e) {

        fetch(ruta_eliminar_empresa, {
            method: "DELETE",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-Token": csrfToken,
            },
            body: JSON.stringify({
                empresa_id: empresa_id,
            }),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.status == 200) {
                    M.toast({
                        html: data.description,
                        classes: "rounded",
                        displayLength: 2000,
                        completeCallback: function () {
                            window.location.href = ruta_index_empresa;
                        },
                    });
                } else {
                    M.toast({
                        html: data.description,
                        classes: "rounded",
                        displayLength: 2000,
                    });
                }
                $('#modalEliminar').hide();
            })
            .catch((error) => {
                M.toast({
                    html: error,
                    classes: "rounded",
                    displayLength: 2000,
                });
            });
    })
})
