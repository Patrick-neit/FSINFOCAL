const csrfToken = document.head.querySelector(
    "[name~=csrf-token][content]"
).content;

// variable declaration
var usersTable;
var usersDataArray = [];
// datatable initialization
if ($("#users-list-datatable").length > 0) {
    usersTable = $("#users-list-datatable").DataTable({
        responsive: true,
        columnDefs: [
            {
                orderable: false,
                targets: [0, 8, 9],
            },
        ],
    });
}
// on click selected users data from table(page named page-users-list)
// to store into local storage to get rendered on second page named page-users-view
$(document).on("click", "#users-list-datatable tr", function () {
    $(this)
        .find("td")
        .each(function () {
            usersDataArray.push($(this).text().trim());
        });

    localStorage.setItem("usersId", usersDataArray[1]);
    localStorage.setItem("usersUsername", usersDataArray[2]);
    localStorage.setItem("usersName", usersDataArray[3]);
    localStorage.setItem("usersVerified", usersDataArray[5]);
    localStorage.setItem("usersRole", usersDataArray[6]);
    localStorage.setItem("usersStatus", usersDataArray[7]);
});
// render stored local storage data on page named page-users-view
if (localStorage.usersId !== undefined) {
    $(".users-view-id").html(localStorage.getItem("usersId"));
    $(".users-view-username").html(localStorage.getItem("usersUsername"));
    $(".users-view-name").html(localStorage.getItem("usersName"));
    $(".users-view-verified").html(localStorage.getItem("usersVerified"));
    $(".users-view-role").html(localStorage.getItem("usersRole"));
    $(".users-view-status").html(localStorage.getItem("usersStatus"));
    // update badge color on status change
    if ($(".users-view-status").text() === "Banned") {
        $(".users-view-status").toggleClass(
            "badge-light-success badge-light-danger"
        );
    }
    // update badge color on status change
    if ($(".users-view-status").text() === "Close") {
        $(".users-view-status").toggleClass(
            "badge-light-success badge-light-warning"
        );
    }
}
// page users list verified filter
$("#users-list-verified").on("change", function () {
    var usersVerifiedSelect = $("#users-list-verified").val();
    usersTable.search(usersVerifiedSelect).draw();
});
// page users list role filter
$("#users-list-role").on("change", function () {
    var usersRoleSelect = $("#users-list-role").val();
    // console.log(usersRoleSelect);
    usersTable.search(usersRoleSelect).draw();
});
// page users list status filter
$("#users-list-status").on("change", function () {
    var usersStatusSelect = $("#users-list-status").val();
    // console.log(usersStatusSelect);
    usersTable.search(usersStatusSelect).draw();
});
// users language select
if ($("#users-language-select2").length > 0) {
    $("#users-language-select2").select2({
        dropdownAutoWidth: true,
        width: "100%",
    });
}
// users music select
if ($("#users-music-select2").length > 0) {
    $("#users-music-select2").select2({
        dropdownAutoWidth: true,
        width: "100%",
    });
}
// users movies select
if ($("#users-movies-select2").length > 0) {
    $("#users-movies-select2").select2({
        dropdownAutoWidth: true,
        width: "100%",
    });
}
$(".select2").select2({
    dropdownAutoWidth: true,
    width: "100%",
});

$(document).ready(function () {
    /* $(".modal").modal(); */
    $(".timepicker").timepicker();
});

$(document).ready(function () {
    $(".datepicker").datepicker({
        format: "dd-mm-yyyy",
        autoClose: true,
    });
});

let registroAprobacionButton = document.getElementById(
    "registrarAprobacionButton"
);
let lote = document.getElementById("lote");
let tipoDocumento = document.getElementById("tipo_documento_id");
let numeroDocumento = document.getElementById("numero_documento");
let metodoPago = document.getElementById("metodo_pago_id");
let pedido_id = document.getElementById("id_pedido");

let productos = document.querySelectorAll(".producto-checkbox");
registroAprobacionButton.addEventListener("click", function (event) {
    event.preventDefault();

    let productosSeleccionados = [];

    productos.forEach((producto) => {
        let productoID = producto.value;

        let fecha_vencimiento = document.querySelector(
            `input[name=fecha_v_${productoID}]`
        );

        console.log(fecha_vencimiento);

        let precioData = {
            producto_id: productoID,
            fecha_vencimiento: fecha_vencimiento.value,
        };

        productosSeleccionados.push(precioData);
        console.log(productosSeleccionados);
    });

    fetch(ruta_aprobar_pedido, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-Token": csrfToken,
        },
        body: JSON.stringify({
            lote: lote.value,
            tipo_documento: tipoDocumento.value,
            numero_documento: numeroDocumento.value,
            metodo_pago: metodoPago.value,
            productos: productosSeleccionados,
            pedido_id: pedido_id.value,
        }),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.status == 200) {
                M.toast({
                    html: data.description,
                    classes: "rounded",
                    displayLength: 2000,
                });
                setTimeout(function () {
                    window.location.href = ruta_pedidos_index;
                });
            } else {
                M.toast({
                    html: data.description,
                    classes: "rounded",
                    displayLength: 2000,
                });
            }
        });
});
