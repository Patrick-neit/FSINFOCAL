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
    $("#monto-giftcard-total").hide();
    $("#monto-giftcard-name").hide();
    $("#monto-giftcard-input").hide();
    $("#numero-tarjeta-input").hide();
    $("#showLoader").hide();
    $("#showClienteInfo").hide();
    $(".timepicker").timepicker();
});

var searchInput = document.getElementById("search_pedido");
var table_producto = document.getElementById("tableDetalleProducto");
var pedido_id = document.getElementById("id_pedido");

searchInput.addEventListener("keypress", function (event) {
    if (event.key === "Enter") {
        event.preventDefault();
    }
});

let registrarPedidoButton = document.getElementById("registrarPedidoButton");
let proveedor_id = document.getElementById("proveedor_id");
let fecha_pedido = document.getElementById("fecha_pedido");
let hora_pedido = document.getElementById("hora_pedido");
let nota = document.getElementById("nota");
$(document).ready(function () {
    $(".datepicker").datepicker();
});
