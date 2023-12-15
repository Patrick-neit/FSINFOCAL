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
    $(".timepicker").timepicker();
});

var searchInput = document.getElementById("search_pedido");

function calcularSubTotal(codigo_producto) {
    let inputPrecioUnitario = document.getElementById(
        "inputPrecioUnitario" + codigo_producto
    );
    let inputCantidad = document.getElementById(
        "inputCantidad" + codigo_producto
    );
    let resultado = inputPrecioUnitario.value * inputCantidad.value;

    document.getElementById("subtotal" + codigo_producto).innerHTML =
        parseFloat(resultado).toFixed(5).toString();
}
function cargarProducto() {
    let table_producto = document.getElementById("tableDetalleProducto");
    fetch(ruta_obtener_producto, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-Token": csrfToken,
        },
        body: JSON.stringify({
            search: searchInput.value,
        }),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.status == 200) {
                if (data.content.bandera == 1) {
                    let row = table_producto.insertRow(-1);

                    let c1 = row.insertCell(0);
                    let c2 = row.insertCell(1);
                    let c3 = row.insertCell(2);
                    let c4 = row.insertCell(3);
                    let c5 = row.insertCell(4);
                    let c6 = row.insertCell(5);

                    var inputCantidad = document.createElement("input");
                    var inputPrecioUnitario = document.createElement("input");

                    inputCantidad.id =
                        "inputCantidad" + data.content.codigo_producto;
                    inputCantidad.value = "1.00000";
                    inputCantidad.type = "number";
                    inputCantidad.min = "0.00001";
                    inputCantidad.step = "0.00001";
                    inputCantidad.oninput = function () {
                        calcularSubTotal(data.content.codigo_producto);
                    };

                    inputPrecioUnitario.id =
                        "inputPrecioUnitario" + data.content.codigo_producto;
                    inputPrecioUnitario.type = "number";
                    inputPrecioUnitario.min = "0.00001";
                    inputPrecioUnitario.step = "0.00001";
                    inputPrecioUnitario.value =
                        data.content.detalle_producto.precio_compra;
                    inputPrecioUnitario.oninput = function () {
                        calcularSubTotal(data.content.codigo_producto);
                    };

                    c1.innerText = data.content.codigo_producto;
                    c2.innerText = data.content.nombre_producto;
                    c3.innerText = data.content.unidad_medida_id;
                    c4.appendChild(inputCantidad);
                    c5.appendChild(inputPrecioUnitario);
                    c6.innerHTML =
                        "<span id='subtotal" +
                        data.content.codigo_producto +
                        "'>1.00000</span>";
                }

                M.toast({
                    html: "Producto añadido",
                    classes: "rounded",
                    displayLength: 2000,
                    completeCallback: function () {
                        /* window.location.href = ruta_index_pedidos; */
                    },
                });
            } else {
                M.toast({
                    html: "Algo salio Mal!",
                    classes: "rounded",
                    displayLength: 2000,
                });
            }
        });
}

searchInput.addEventListener("keypress", function (event) {
    if (event.key === "Enter") {
        event.preventDefault();
    }
});

let registrarMarcaButton = document.getElementById("registrarMarcaButton");
let nombre_marca = document.getElementById("nombre_marca");
let estado = document.getElementById("estado");
let marca_id = document.getElementById("id_marca");

registrarMarcaButton.addEventListener("click", function (event) {
    event.preventDefault();

    fetch(ruta_guardar_marca, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-Token": csrfToken,
        },
        body: JSON.stringify({
            nombre_marca: nombre_marca.value,
            estado: estado.value,
            marca_id: marca_id.value,
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
                        window.location.href = ruta_index_marca;
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
        });
});
