$(document).ready(function () {
    $('select[required]').css({
        display: 'inline',
        position: 'absolute',
        float: 'left',
        padding: 0,
        margin: 0,
        border: '1px solid rgba(255,255,255,0)',
        height: 0,
        width: 0,
        top: '2em',
        left: '3em'
    });
    $("#formCategoria").validate({
        errorLabelContainer: "#messageBox",
        wrapper: "li",
        rules: {
            nombre_categoria: 'required',
            estado: 'required',
        },
        errorClass: 'invalid',
        validClass: "valid",
        submitHandler: function (form) {
            const formData = new FormData();
            formData.append("nombre_categoria", nombre_categoria.value);
            formData.append("estado", estado.value);
            if (categoria_id) {
                formData.append("categoria_id", categoria_id);
            }
            fetch(!categoria_id ? ruta_guardar_categoria : `${ruta_update_categoria}`, {
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
                            html: "Guardado Exitosamente!",
                            classes: "rounded",
                            displayLength: 3000,
                            completeCallback: function () {
                                window.location.href = ruta_index;
                            },
                        });
                    } else {
                        M.toast({
                            html: "Algo salió Mal!",
                            classes: "rounded blue lighten-1",
                            displayLength: 3000,
                        });
                    }
                })
                .catch((error) => {
                    console.log(error);
                    M.toast({
                        html: "Algo salió Mal!",
                        classes: "rounded blue lighten-1",
                        displayLength: 3000,
                    });
                });
        }
    });
})