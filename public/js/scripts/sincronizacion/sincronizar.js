const csrfToken = document.head.querySelector(
    "[name~=csrf-token][content]"
).content;


$(document).ready(function () {
    $('table.table').DataTable({
        searching: false,
        language: {
            sProcessing: "Procesando...",
            sLengthMenu: "Mostrar _MENU_ registros",
            sZeroRecords: "No se encontraron resultados",
            sEmptyTable: "Ningun dato disponible en esta tabla",
            sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
            sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
            sInfoPostFix: "",
            sSearch: "Buscar:",
            sUrl: "",
            sInfoThousands: ",",
            sLoadingRecords: "Cargando...",
            oPaginate: {
                sFirst: "Primero",
                sLast: "Ãšltimo",
                sNext: "Siguiente",
                sPrevious: "Anterior"
            },
            oAria: {
                sSortAscending: ": Activar para ordenar la columna de manera ascendente",
                sSortDescending: ": Activar para ordenar la columna de manera descendente"
            }
        },

    });
});

let sincronizacion = document.querySelectorAll('#sincronizacion');

sincronizacion.forEach((item) => {
    item.addEventListener('click', (e) => {
        
        let tabs = document.querySelectorAll('.tabs');
        M.Tabs.init(tabs);

        let tabLinks = document.querySelectorAll('#tabs a');
        tabLinks.forEach(function (tabLink) {
            tabLink.addEventListener('click', function () {
                let tabActivo = this.getAttribute('href');
                ruta_sinc_sincronizar = ruta_sinc_sincronizar.
                    replace('accion', tabActivo.substring(1, tabActivo.length))
            });
        });

        let tabActivoInicial = document.querySelector('#tabs .tab a.active').getAttribute('href');
        ruta_sinc_sincronizar = ruta_sinc_sincronizar.replace('accion', tabActivoInicial.substring(1, tabActivoInicial.length))
        
        fetch(ruta_sinc_sincronizar, {
            method: "GET",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.status == 200) {
                    if (data.content.transaccion) {
                        M.toast({
                            html: "Sincronizado Correctamente",
                            classes: "rounded",
                            displayLength: 2000,
                            completeCallback: function () {
                                window.location.href = window.location.href;
                            },
                        });
                    } else {
                        M.toast({
                            html:
                                data.content.mensajesList[0].codigo +
                                "-" +
                                data.content.mensajesList[0].descripcion,
                            classes: "rounded",
                            displayLength: 2000,
                            completeCallback: function () {
                                console.log("completeCallback");
                            },
                        });
                    }
                } else {
                    M.toast({
                        html: data.description,
                        classes: "rounded",
                        displayLength: 3000,
                        classes: "blue lighten-1",
                    });
                }
            })
            .catch((error) => {
                M.toast({
                    html: data.content.message,
                    classes: "rounded",
                    displayLength: 3000,
                    classes: "blue lighten-1",
                });
            });
    })
})