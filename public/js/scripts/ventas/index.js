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
    $("#monto-giftcard-name").hide();
    $("#monto-giftcard-input").hide();
    $("#numero-tarjeta-input").hide();
    $(".timepicker").timepicker();
});


function getDataCliente(){
    let cliente_id = document.getElementById('cliente_id');
    if (cliente_id.value == "x") {
        M.toast({
            html: "Debe Seleccionar un Cliente!",
            classes: "rounded",
            displayLength: 2000,
        });
    }else{
        fetch(ruta_obtener_cliente , {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-Token": csrfToken,
            },
            body: JSON.stringify({
                cliente_id: cliente_id.value,
            }),
        })
        .then((response) => response.json())
            .then((data) => {
                console.log(data);
                if (data.status == 200) {
                    document.getElementById('nit_cliente_visual').innerHTML  = "NIT: " + data.content.cliente.data_cliente.numero_nit;
                    document.getElementById('correo_cliente_visual').innerHTML  = "CORREO: "+  data.content.cliente.data_cliente.correo;
                    M.toast({
                        html: data.content.cliente.data_nit,
                        classes: "rounded",
                        displayLength: 2000,
                    });
                } else {
                    M.toast({
                        html: data.description,
                        classes: "rounded",
                        displayLength: 2000,
                    });
                }
            });
    }
}

function getTipoPagoInputs(select){

        var selectedText = $(select).find("option:selected").text();
        console.log(selectedText);
        if (selectedText.includes("GIFT") && selectedText.includes("TARJETA")) {
            $("#monto-giftcard-name").show();
            $("#monto-giftcard-input").show();
            $("#numero-tarjeta-input").show();

        } else {
            $("#monto-giftcard-name").hide();
            $("#monto-giftcard-input").hide();
            $("#numero-tarjeta-input").hide();

          if (selectedText.includes("GIFT")) {
            $("#monto-giftcard-name").show();
            $("#monto-giftcard-input").show();
          } else {
            if (selectedText.includes("TARJETA")) {
                $("#numero-tarjeta-input").show();
            } else {
                $("#numero-tarjeta-input").hide();
            }
          }
        }
}

var searchInput = document.getElementById("search_pedido");
var table_producto = document.getElementById("tableDetalleProducto");
var pedido_id = document.getElementById("id_pedido");
function calcularSubTotal(codigo_producto) {
    let inputPrecioUnitario = document.getElementById(
        "inputPrecioUnitario" + codigo_producto
    );
    let inputCantidad = document.getElementById(
        "inputCantidad" + codigo_producto
    );
    let resultado = inputPrecioUnitario.value * inputCantidad.value;

    //-------------------------------------

    fetch(ruta_actualizar_cart, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-Token": csrfToken,
        },
        body: JSON.stringify({
            codigo_producto: codigo_producto,
            cantidad: inputCantidad.value,
            precio_unitario: inputPrecioUnitario.value,
            subtotal: resultado,
        }),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.status == 200) {
                //subtotal de cada producto
                document.getElementById(
                    "subtotal" + codigo_producto
                ).innerHTML = parseFloat(resultado).toFixed(5).toString();
                document.getElementById("subTotal").innerHTML =
                    "Bs. " + parseFloat(data.content).toFixed(5).toString();
                document.getElementById("totalDolar").innerHTML =
                    "Bs. " +
                    parseFloat(data.content * 6.96)
                        .toFixed(5)
                        .toString();
            } else {
                M.toast({
                    html: "Algo salio Mal!",
                    classes: "rounded",
                    displayLength: 2000,
                });
            }
        });

    //-----------------------------------
}
function cargarProducto() {
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
                    row.id = data.content.codigo_producto;
                    let c1 = row.insertCell(0);
                    let c2 = row.insertCell(1);
                    let c3 = row.insertCell(2);
                    let c4 = row.insertCell(3);
                    let c5 = row.insertCell(4);
                    let c6 = row.insertCell(5);
                    let c7 = row.insertCell(6);
                    let c8 = row.insertCell(7);

                    var inputCantidad = document.createElement("input");
                    var inputPrecioUnitario = document.createElement("input");

                    var inputDescuento = document.createElement("input");

                    inputCantidad.id =
                        "inputCantidad" + data.content.codigo_producto;
                    inputCantidad.value = "1.00000";
                    inputCantidad.type = "number";
                    inputCantidad.min = "0.00001";
                    inputCantidad.step = "0.00001";
                    inputCantidad.onchange = function () {
                        calcularSubTotal(data.content.codigo_producto);
                    };

                    inputPrecioUnitario.id =
                        "inputPrecioUnitario" + data.content.codigo_producto;
                    inputPrecioUnitario.type = "number";
                    inputPrecioUnitario.min = "0.00001";
                    inputPrecioUnitario.step = "0.00001";
                    inputPrecioUnitario.value =
                        data.content.detalle_producto.precio_compra;
                    inputPrecioUnitario.onchange = function () {
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
                        "'>" +
                        parseFloat(
                            data.content.detalle_producto.precio_compra * 1
                        )
                            .toFixed(5)
                            .toString() +
                        "</span>";
                    c8.appendChild(inputCantidad);
                    c7.innerHTML =
                        "<i id class='material-icons prefix' onclick='deleteRow(" +
                        data.content.codigo_producto +
                        ")'>delete</i>";
                    //insertando datos al subtotal y total
                    calcularSubTotal(data.content.codigo_producto);
                }
            } else {
                M.toast({
                    html: "Algo salio Mal!",
                    classes: "rounded",
                    displayLength: 2000,
                });
            }
        });
}
//TODO: SEGUIR CON LOFICA PERO ADEMAS AÑADIR LA ACTUALIZACION Y REMOCION DE L ITEM
function cambiarTabla(item_id) {
    /* table_producto.innerHTML = ""; */
    var tableRows = table_producto.getElementsByTagName("tr");
    var rowCount = tableRows.length;

    for (var x = rowCount - 1; x > 0; x--) {
        table_producto.deleteRow(x);
    }
    fetch(rutal_all_cart, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-Token": csrfToken,
        },
        body: JSON.stringify({
            cart_id: item_id,
        }),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.status == 200) {
                let claves = Object.keys(data.content);
                if (claves.length == 0) {
                    document.getElementById("subTotal").innerHTML =
                        "Bs. 0.00000";
                    document.getElementById("totalDolar").innerHTML =
                        "Bs. 0.00000";
                } else {
                    for (let i = 0; i < claves.length; i++) {
                        let clave = claves[i];

                        let dataObject = data.content[clave].options;
                        let row = table_producto.insertRow(-1);
                        row.id = dataObject.codigo_producto;
                        let c1 = row.insertCell(0);
                        let c2 = row.insertCell(1);
                        let c3 = row.insertCell(2);
                        let c4 = row.insertCell(3);
                        let c5 = row.insertCell(4);
                        let c6 = row.insertCell(5);
                        let c7 = row.insertCell(6);

                        var inputCantidad = document.createElement("input");
                        var inputPrecioUnitario =
                            document.createElement("input");

                        inputCantidad.id = "inputCantidad" + dataObject.id;
                        inputCantidad.value = dataObject.qty;
                        inputCantidad.type = "number";
                        inputCantidad.min = "0.00001";
                        inputCantidad.step = "0.00001";
                        inputCantidad.onchange = function () {
                            calcularSubTotal(dataObject.id);
                        };

                        inputPrecioUnitario.id =
                            "inputPrecioUnitario" + dataObject.id;
                        inputPrecioUnitario.type = "number";
                        inputPrecioUnitario.min = "0.00001";
                        inputPrecioUnitario.step = "0.00001";
                        inputPrecioUnitario.value = parseFloat(
                            dataObject.price
                        ).toFixed(5);
                        inputPrecioUnitario.onchange = function () {
                            calcularSubTotal(dataObject.id);
                        };

                        c1.innerText = dataObject.id;
                        c2.innerText = dataObject.name;
                        c3.innerText = dataObject.unidad_medida_literal;
                        c4.appendChild(inputCantidad);
                        c5.appendChild(inputPrecioUnitario);
                        c6.innerHTML =
                            "<span id='subtotal" +
                            dataObject.id +
                            "'>" +
                            parseFloat(dataObject.price * 1)
                                .toFixed(5)
                                .toString() +
                            "</span>";

                        c7.innerHTML =
                            "<a id='" +
                            dataObject.id +
                            "' name='" +
                            dataObject.id +
                            "' class='waves-effect waves-light btn' onclick='cambiarTabla(this.name)'><i class='material-icons prefix'>delete</i></a>";
                        calcularSubTotal(dataObject.id);
                    }
                }
            } else {
                M.toast({
                    html: "Algo salio Mal!",
                    classes: "rounded",
                    displayLength: 2000,
                });
            }
        });
}

function deleteRow(posicion) {
    var table = document.getElementById("tableDetalleProducto");
    var row = document.getElementById(posicion);
    table.deleteRow(row.rowIndex + 1);
}

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

registrarPedidoButton.addEventListener("click", function (event) {
    event.preventDefault();

    fetch(ruta_guardar_pedido, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-Token": csrfToken,
        },
        body: JSON.stringify({
            proveedor_id: proveedor_id.value,
            fecha_pedido: fecha_pedido.value,
            hora_pedido: hora_pedido.value,
            nota: nota.value,
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
                    completeCallback: function () {
                        window.location.href = ruta_index_pedido;
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
$(document).ready(function () {
    $(".datepicker").datepicker();
});
