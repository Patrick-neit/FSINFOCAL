$(document).ready(function () {
    let user_id = null;
    $('tbody').on('click', '#eliminarUser', function (e) {
        user_id = $(this).data('id');
    });

    $('#confirmEliminar').on('click', function (e) {

        fetch(ruta_eliminar_user, {
            method: "DELETE",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-Token": csrfToken,
            },
            body: JSON.stringify({
                user_id: user_id,
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
                            window.location.href = ruta_index_user;
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
