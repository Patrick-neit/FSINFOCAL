$(document).ready(function () {
    let sub_familia_id = null;
    $('tbody').on('click', '#eliminarSubFamilia', function (e) {
        sub_familia_id = $(this).data('id');
    });
    $('#confirmEliminar').on('click', function (e) {
        fetch(ruta_eliminar_sub_familia, {
            method: "DELETE",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-Token": csrfToken,
            },
            body: JSON.stringify({
                sub_familia_id: sub_familia_id,
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
                            window.location.href = ruta_index_sub_familia;
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
