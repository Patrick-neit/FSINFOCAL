const csrfToken = document.head.querySelector(
    "[name~=csrf-token][content]"
).content;

$(document).ready(function () {
    "use strict";
    /*
     * DataTables - Tables
     */
    var calcDataTableHeight = function () {
        return $(window).height() - 500 + "px";
    };

    var table = $("#data-table-contact").DataTable({
        scrollY: calcDataTableHeight(),
        scrollCollapse: true,
        scrollX: false,
        paging: true,
        responsive: true,
        lengthMenu: [15],
        language: {
            decimal: "",
            emptyTable: "No hay información",
            info: "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            infoEmpty: "Mostrando 0 to 0 of 0 Entradas",
            infoFiltered: "(Filtrado de _MAX_ total entradas)",
            infoPostFix: "",
            thousands: ",",
            lengthMenu: "Mostrar _MENU_ Entradas",
            loadingRecords: "Cargando...",
            processing: "Procesando...",
            search: "Buscar:",
            zeroRecords: "Sin resultados encontrados",
            paginate: {
                first: "Primero",
                last: "Ultimo",
                next: "Siguiente",
                previous: "Anterior",
            },
        },
        /* aoColumns: [
            {
                bSortable: false
            },
            {
                bSortable: false
            },
            null,
            null,
            null,
            {
                bSortable: false
            },
            {
                bSortable: false
            }
        ], */
        fnInitComplete: function () {
            var ps_datatable = new PerfectScrollbar(".dataTables_scrollBody");
        },
        //on paginition page 2,3.. often scroll shown, so reset it and assign it again
        fnDrawCallback: function (oSettings) {
            var ps_datatable = new PerfectScrollbar(".dataTables_scrollBody");
        },
    });

    // Custom search
    function filterGlobal() {
        table
            .search(
                $("#global_filter").val(),
                $("#global_regex").prop("checked"),
                $("#global_smart").prop("checked")
            )
            .draw();
    }

    function filterColumn(i) {
        table
            .column(i)
            .search(
                $("#col" + i + "_filter").val(),
                $("#col" + i + "_regex").prop("checked"),
                $("#col" + i + "_smart").prop("checked")
            )
            .draw();
    }

    $("input#global_filter").on("keyup click", function () {
        filterGlobal();
    });

    $("input.column_filter").on("keyup click", function () {
        filterColumn($(this).parents("tr").attr("data-column"));
    });

    //  Notifications & messages scrollable
    if ($("#sidebar-list").length > 0) {
        var ps_sidebar_list = new PerfectScrollbar("#sidebar-list", {
            theme: "dark",
        });
    }

    // Favorite star click
    $(".app-page .favorite i").on("click", function (e) {
        e.preventDefault();
        $(this).toggleClass("amber-text");
    });

    // Toggle class of sidenav
    $("#contact-sidenav").sidenav({
        onOpenStart: function () {
            $("#sidebar-list").addClass("sidebar-show");
        },
        onCloseEnd: function () {
            $("#sidebar-list").removeClass("sidebar-show");
        },
    });

    // Remove Row for datatable in responsive
    $(document).on("click", ".app-page i.delete", function () {
        var $tr = $(this).closest("tr");
        if ($tr.prev().hasClass("parent")) {
            $tr.prev().remove();
        }
        $tr.remove();
    });

    $("#contact-sidenav li").on("click", function () {
        var $this = $(this);
        if (!$this.hasClass("sidebar-title")) {
            $("li").removeClass("active");
            $this.addClass("active");
        }
    });

    // Modals Popup
    $(".modal").modal();

    // Close other sidenav on click of any sidenav
    if ($(window).width() > 900) {
        $("#contact-sidenav").removeClass("sidenav");
    }

    // contact-overlay and sidebar hide
    // --------------------------------------------
    var contactOverlay = $(".contact-overlay"),
        updatecontact = $(".update-contact"),
        addcontact = $(".add-contact"),
        contactComposeSidebar = $(".contact-compose-sidebar"),
        labelEditForm = $("label[for]");
    $(".contact-sidebar-trigger").on("click", function () {
        contactOverlay.addClass("show");
        updatecontact.addClass("display-none");
        addcontact.removeClass("display-none");
        contactComposeSidebar.addClass("show");
        labelEditForm.removeClass("active");
        $("#card_image").css("display", "none");
        $(".contact-compose-sidebar input").val("");
    });
    $(
        ".contact-compose-sidebar .update-contact, .contact-compose-sidebar .close-icon, .contact-compose-sidebar .add-contact, .contact-overlay"
    ).on("click", function () {
        contactOverlay.removeClass("show");
        contactComposeSidebar.removeClass("show");
        console.log("entro aqui cerrar");
    });

    $(".dataTables_scrollBody tr")
        .on("click", function () {
            fetch(ruta_get_user_show, {
                method: "POST",
                headers: {
                    "X-CSRF-Token": csrfToken,
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    user_id: $(this).attr("id"),
                }),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.status == 200) {
                        let dataUser = data.content;

                        updatecontact.removeClass("display-none");
                        addcontact.addClass("display-none");
                        contactOverlay.addClass("show");
                        contactComposeSidebar.addClass("show");
                        $("#user_id").val(dataUser.id);
                        $("#name_user").val(dataUser.name);
                        $("#email").val(dataUser.email);
                        $("#estado").val(dataUser.estado).trigger("change");
                        let card_image = document.getElementById("card_image");
                        let image_element =
                            document.getElementById("image_element");
                        card_image.style.removeProperty("display");

                        image_element.src = ruta_recursos + dataUser.avatar;
                        //remove style this card_image
                        card_image.style.display = "block";
                        0.2;
                        labelEditForm.addClass("active");
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
        })
        .on("click", ".checkbox-label,.favorite,.delete", function (e) {
            e.stopPropagation();
        });

    if (contactComposeSidebar.length > 0) {
        var ps_compose_sidebar = new PerfectScrollbar(
            ".contact-compose-sidebar",
            {
                theme: "dark",
                wheelPropagation: false,
            }
        );
    }

    // for rtl
    if ($("html[data-textdirection='rtl']").length > 0) {
        // Toggle class of sidenav
        $("#contact-sidenav").sidenav({
            edge: "right",
            onOpenStart: function () {
                $("#sidebar-list").addClass("sidebar-show");
            },
            onCloseEnd: function () {
                $("#sidebar-list").removeClass("sidebar-show");
            },
        });
    }
});
let name_user = document.getElementById("name_user");
let email = document.getElementById("email");
let password = document.getElementById("password");
let estado = document.getElementById("estado");
let avatar = document.getElementById("avatar");
let user_id_update = document.getElementById("user_id");
/**
 * Actualizar usuario
 */
let actualizarUsuarioButton = document.getElementById("actualizarUser");

actualizarUsuarioButton.addEventListener("click", function (event) {
    event.preventDefault();
    const formData = new FormData();
    formData.append("avatar", avatar.files[0]);
    formData.append("name", name_user.value);
    formData.append("email", email.value);
    formData.append("password", password.value);
    formData.append("estado", estado.value);
    formData.append("user_id", user_id_update.value);

    fetch(ruta_user_update, {
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
                        window.location.href = ruta_index_user;
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
/* $(document).ready(function(){
    $('.datepicker').datepicker();
  }); */

/* Registrar Alumno */
/* let registrarDocenteButton = document.getElementById("registrarDocente");

let first_name = document.getElementById("first_name");
let matricula_docente = document.getElementById("matricula");
let fecha_incorporacion_docente = document.getElementById(
    "fecha_incorporacion"
);
let phone_docente = document.getElementById("telefono");
let direccion = document.getElementById("direccion");
let estado = document.getElementById("estado");
let avatar = document.getElementById("avatar"); */
let registrarDocenteButton = document.getElementById("registrarDocente");

registrarDocenteButton.addEventListener("click", function (event) {
    event.preventDefault();
    const formData = new FormData();
    formData.append("avatar", avatar.files[0]);
    formData.append("name", name_user.value);
    formData.append("email", email.value);
    formData.append("password", password.value);
    formData.append("estado", estado.value);

    fetch(ruta_guardar_user, {
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
                        window.location.href = ruta_index_user;
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

/* Eliminar Docente */
function eliminar(e) {
    console.log(e);
    fetch(ruta_eliminar_user, {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-Token": csrfToken,
        },
        body: JSON.stringify({
            user_id: e,
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
        })
        .catch((error) => {
            M.toast({
                html: error,
                classes: "rounded",
                displayLength: 2000,
            });
        });
}

// Sidenav
$(".sidenav-trigger").on("click", function () {
    if ($(window).width() < 960) {
        $(".sidenav").sidenav("close");
        $(".app-sidebar").sidenav("close");
    }
});

// Select all checkbox on click of header checkbox
function toggle(source) {
    checkboxes = document.getElementsByName("foo");
    for (var i = 0, n = checkboxes.length; i < n; i++) {
        checkboxes[i].checked = source.checked;
    }
}

$(window).on("resize", function () {
    resizetable();

    if ($(window).width() > 899) {
        $("#contact-sidenav").removeClass("sidenav");
    }

    if ($(window).width() < 900) {
        $("#contact-sidenav").addClass("sidenav");
    }
});

function resizetable() {
    $(".app-page .dataTables_scrollBody").css({
        maxHeight: $(window).height() - 420 + "px",
    });
}
resizetable();

// For contact sidebar on small screen
if ($(window).width() < 900) {
    $(".sidebar-left.sidebar-fixed").removeClass(
        "animate fadeUp animation-fast"
    );
    $(".sidebar-left.sidebar-fixed .sidebar").removeClass("animate fadeUp");
}
