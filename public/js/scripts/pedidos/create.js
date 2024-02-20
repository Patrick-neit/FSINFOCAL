const csrfToken = document.head.querySelector(
    "[name~=csrf-token][content]"
).content;

let searchInput = document.getElementById("search_pedido");
let table_producto = document.getElementById("tableDetalleProducto");
let pedido_id = document.getElementById("id_pedido");

let registrarPedidoButton = document.getElementById("registrarPedidoButton");
let proveedor_id = document.getElementById("proveedor_id");
let fecha_pedido = document.getElementById("fecha_pedido");
let hora_pedido = document.getElementById("hora_pedido");
let nota = document.getElementById("nota");

$(".select2").select2({
    dropdownAutoWidth: true,
    width: "100%",
});


$(document).ready(function () {
    $(".timepicker").timepicker();
    $("textarea#nota").characterCounter();
    $("#nota").val('');
    if (pedido) {
        $("#nota").val(pedido.nota);
    }
});

searchInput.addEventListener("keypress", function (event) {
    if (event.key === "Enter") {
        event.preventDefault();
    }
});

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
    $("#formPedido").validate({
        errorLabelContainer: "#messageBox",
        wrapper: "li",
        rules: {
            proveedor_id: 'required',
            fecha_pedido: 'required',
            hora_pedido: 'required',
            nota: 'required',
        },
        errorClass: 'invalid',
        validClass: "valid",
        errorPlacement: function (label, element) {
            if (element.hasClass('select2 browser-default')) {
                label.insertAfter(element.next('.select2-container')).addClass('mt-2 text-danger');
                select2label = label
            } else {
                label.addClass('mt-2 text-danger');
                label.insertAfter(element);
            }
        },
        submitHandler: function (form) {
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
        }
    });
})

function cambiarTabla(item_id) {
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
                    for (const element of claves) {
                        let clave = element;
                        let dataObject = data.content[clave].options;
                        let objetoProducto = {
                            codigo_producto: dataObject.id,
                            nombre_producto: dataObject.name,
                            qty: dataObject.qty,
                            unidad_medida_id: dataObject.unidad_medida_literal,
                            detalle_producto: {
                                precio_compra: dataObject.price
                            }
                        }
                        addRowInTable(objetoProducto)
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


function eliminarItem(codigo_producto) {
    fetch(ruta_remove_item_cart, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-Token": csrfToken,
        },
        body: JSON.stringify({
            codigo_producto: codigo_producto,
        }),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.status == 200) {
                document.getElementById("subTotal").innerHTML =
                    "Bs. " + parseFloat(data.content).toFixed(5).toString();
                document.getElementById("totalDolar").innerHTML =
                    "Bs. " +
                    parseFloat(data.content * 6.96)
                        .toFixed(5)
                        .toString();
            }
        });
}

function calcularSubTotal(codigo_producto) {
    let inputPrecioUnitario = document.getElementById(`inputPrecioUnitario${codigo_producto}`);
    let inputCantidad = document.getElementById(`inputCantidad${codigo_producto}`);
    let resultado = inputPrecioUnitario.value * inputCantidad.value;

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
            console.log(data)
            if (data.status == 200) {
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
                    addRowInTable(data.content)
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

function deleteRowCustom(codigo_producto) {
    console.log(codigo_producto)
    let row = document.getElementById(codigo_producto);
    eliminarItem(codigo_producto)
    table_producto.deleteRow(row.rowIndex);
}

function addRowInTable(producto) {
    let row = table_producto.insertRow(-1);
    row.id = producto.codigo_producto;
    let c1 = row.insertCell(0);
    let c2 = row.insertCell(1);
    let c3 = row.insertCell(2);
    let c4 = row.insertCell(3);
    let c5 = row.insertCell(4);
    let c6 = row.insertCell(5);
    let c7 = row.insertCell(6);

    let inputCantidad = document.createElement("input");
    let inputPrecioUnitario = document.createElement("input");

    inputCantidad.id = "inputCantidad" + producto.codigo_producto;
    inputCantidad.value = producto.qty ?? '1.00000';
    inputCantidad.type = "number";
    inputCantidad.min = "0.00001";
    inputCantidad.step = "0.00001";
    inputCantidad.onchange = function () {
        calcularSubTotal(producto.codigo_producto);
    };

    inputPrecioUnitario.id =
        "inputPrecioUnitario" + producto.codigo_producto;
    inputPrecioUnitario.type = "number";
    inputPrecioUnitario.min = "0.00001";
    inputPrecioUnitario.step = "0.00001";
    inputPrecioUnitario.value = parseFloat(
        producto.detalle_producto.precio_compra
    ).toFixed(5);
    inputPrecioUnitario.onchange = function () {
        calcularSubTotal(producto.codigo_producto);
    };

    c1.innerText = producto.codigo_producto;
    c2.innerText = producto.nombre_producto;
    c3.innerText = producto.unidad_medida_id;
    c4.appendChild(inputCantidad);
    c5.appendChild(inputPrecioUnitario);
    c6.innerHTML =
        "<span id='subtotal" +
        producto.codigo_producto +
        "'>" +
        parseFloat(producto.detalle_producto.precio_compra * 1)
            .toFixed(5)
            .toString() +
        "</span>";
    c7.innerHTML = `<button type='button' class='btn btn-floating red' onclick='deleteRowCustom(${JSON.stringify(producto.codigo_producto)})'><i id class='material-icons'>delete</i></button>`;
    calcularSubTotal(producto.codigo_producto);
}
