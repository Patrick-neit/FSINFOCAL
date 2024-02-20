$(document).ready(function () {
    let id = null;
    let data = {};
    $('tbody').on('click', '#eliminar', function (e) {
        id = $(this).data('id');
        data[key_id] = id;
    });

    $('#confirmEliminar').on('click', function (e) {
        fetch(`ruta_eliminar/${id}`, {
            method: "DELETE",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-Token": csrfToken,
            },
            body: JSON.stringify(data),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.status == 200) {
                    console.log(data)
                    M.toast({
                        html: 'Eliminado Satisfactoriamente',
                        classes: "rounded",
                        displayLength: 2000,
                        completeCallback: function () {
                            window.location.href = ruta_index;
                        },
                    });
                } else {
                    console.log(data)
                    M.toast({
                        html: 'Error Inesperado',
                        classes: "rounded",
                        displayLength: 2000,
                    });
                }
                $('#modalEliminar').hide();
            })
            .catch((error) => {
                console.log(error)
                M.toast({
                    html: 'Error Inesperado',
                    classes: "rounded",
                    displayLength: 2000,
                });
            });
    })
})
