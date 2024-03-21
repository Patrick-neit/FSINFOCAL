const csrfToken = document.head.querySelector(
    "[name~=csrf-token][content]"
).content;

/**
 * Funcion para registrar la venta
 * @param {string} ruta_registrar_venta
 * @param {string} csrfToken
 * @return {void}
 */
function registrarVenta() {
    fetch(ruta_registrar_venta, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-Token": csrfToken,
        },
        body: JSON.stringify({
            tipo_pago: document.getElementById("tipo_pago_id").value,
            moneda: document.getElementById("tipo_moneda_id").value,
            nota: document.getElementById("nota").value,
            cliente_id: document.getElementById("cliente_id").value,
            data_montos: {
                importe_total: document.getElementById("importeTotal").value,
            },
        }),
    })
        .then((response) => {
            console.log(response);
        })
        .catch((error) => {
            console.log(error);
        });
}

function getDataCliente() {
    $("#showLoader").show();
    let cliente_id = document.getElementById("cliente_id");
    let cliente_email = document.getElementById("correo_cliente_visual");
    let cliente_nit = document.getElementById("nit_cliente_visual");
    if (cliente_id.value == "x") {
        M.toast({
            html: "Debe Seleccionar un Cliente!",
            classes: "rounded",
            displayLength: 2000,
        });
    } else {
        fetch(ruta_obtener_cliente, {
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
                if (data.status == 200) {
                    $("#showClienteInfo").show();
                    cliente_nit.innerHTML =
                        "NIT: " + data.content.cliente.data_cliente.numero_nit;
                    cliente_email.innerHTML =
                        "CORREO: " + data.content.cliente.data_cliente.correo;
                    M.toast({
                        html:
                            data.content.cliente.data_nit == false
                                ? "Cliente no consultado(SIN)"
                                : "CLiente obtenido",
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
                $("#showLoader").hide();
            });
    }
}

function getTipoPagoInputs(select) {
    var selectedText = $(select).find("option:selected").text();
    if (selectedText.includes("GIFT") && selectedText.includes("TARJETA")) {
        $("#monto-giftcard-total").show();
        $("#numero-tarjeta-input").show();
        $("#numero-tarjeta-input").show();
    } else {
        $("#numero-tarjeta-input").hide();
        $("#monto-giftcard-total").show();
        $("#numero-tarjeta-input").hide();

        if (selectedText.includes("GIFT")) {
            $("#monto-giftcard-total").show();
        } else {
            if (selectedText.includes("TARJETA")) {
                $("#numero-tarjeta-input").show();
            } else {
                $("#numero-tarjeta-input").hide();
            }
        }
    }
}

function validarNumeros(numero) {
    if ([null, undefined, "", " "].includes(numero)) {
        return true;
    }
    if (isNaN(numero)) {
        return true;
    }
    return false;
}

function calcularSubTotal(codigo_producto) {
    $("#showLoader").show();
    let inputPrecioUnitario = document.getElementById(
        "inputPrecioUnitario" + codigo_producto
    );
    let inputCantidad = document.getElementById(
        "inputCantidad" + codigo_producto
    );

    let inputDescuento = document.getElementById(
        "inputDescuento" + codigo_producto
    );

    //seccion que valdia valores vacios
    if (validarNumeros(inputPrecioUnitario.value)) {
        M.toast({
            html: "No se puede dejar el precio unitario vacio!",
            classes: "rounded",
            displayLength: 2000,
        });
        return;
    }

    if (validarNumeros(inputCantidad.value)) {
        M.toast({
            html: "No se puede dejar la cantidad vacia!",
            classes: "rounded",
            displayLength: 2000,
        });
        return;
    }

    if (inputDescuento.value > inputPrecioUnitario.value) {
        M.toast({
            html: "El descuento no puede ser mayor al precio unitario!",
            classes: "rounded",
            displayLength: 2000,
        });
        return;
    }

    let resultado =
        inputPrecioUnitario.value * inputCantidad.value - inputDescuento.value;

    if (resultado < 0) {
        M.toast({
            html: "El descuento no puede ser mayor al precio unitario!",
            classes: "rounded",
            displayLength: 2000,
        });
        return;
    }

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
            descuento: inputDescuento.value,
            precio_unitario: inputPrecioUnitario.value,
            subtotal: resultado,
        }),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.status == 200) {
                let subTotalCart = data.content;
                //subtotal de cada producto
                document.getElementById(
                    "subtotal" + codigo_producto
                ).innerHTML = parseFloat(resultado).toFixed(5).toString();
                document.getElementById("importeTotal").innerHTML =
                    "Bs. " + parseFloat(subTotalCart).toFixed(5).toString();

                document.getElementById("subTotal").innerHTML =
                    "Bs. " + parseFloat(subTotalCart).toFixed(5).toString();
                calcularTotal(subTotalCart);
                /* document.getElementById("totalDolar").innerHTML =
                    "Bs. " +
                    parseFloat(data.content * 6.96)
                        .toFixed(5)
                        .toString(); */
            } else {
                M.toast({
                    html: "Algo salio Mal en calculo del SubTotal!",
                    classes: "rounded",
                    displayLength: 2000,
                });
            }
        });
    //-----------------------------------
}
function calcularTotal(subTotal) {
    let descuentoAdicional = document.getElementById(
        "descuento_adicional"
    ).value;

    let elementTotal = document.getElementById("total");
    let elementSubTotal = document.getElementById("subTotal");

    if (descuentoAdicional > subTotal) {
        M.toast({
            html: "El descuento no puede ser mayor al subtotal!",
            classes: "rounded",
            displayLength: 2000,
        });
        return;
    }

    if (descuentoAdicional < 0) {
        M.toast({
            html: "El descuento no puede ser menor a cero!",
            classes: "rounded",
            displayLength: 2000,
        });
        return;
    }

    fetch(ruta_obtener_subtotal_cart, {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-Token": csrfToken,
        },
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.status == 200) {
                subTotal = parseFloat(data.content);

                let elementGiftCard = parseFloat(
                    document.getElementById("monto_giftcard").value
                );

                //bloque de validaciones
                /* if (validarNumeros(elementGiftCard)) {
                    M.toast({
                        html: "No se puede dejar el GiftCard vacio o nulo!",
                        classes: "rounded",
                        displayLength: 2000,
                    });
                    return;
                } */

                if (elementGiftCard < 0) {
                    M.toast({
                        html: "El GiftCard no puede ser menor a cero!",
                        classes: "rounded",
                        displayLength: 2000,
                    });
                    return;
                }

                if (subTotal - descuentoAdicional < 0) {
                    M.toast({
                        html: "El descuento no puede ser mayor al subtotal!",
                        classes: "rounded",
                        displayLength: 2000,
                    });
                    return;
                }

                if (subTotal == elementGiftCard || elementGiftCard > subTotal) {
                    document.getElementById("monto_giftcard").value = "0.00000";
                    elementTotal.innerHTML =
                        "Bs. " +
                        parseFloat(subTotal - descuentoAdicional)
                            .toFixed(5)
                            .toString();
                    elementSubTotal.innerHTML =
                        "Bs. " +
                        parseFloat(subTotal - descuentoAdicional)
                            .toFixed(5)
                            .toString();
                    document.getElementById("totalDolar").innerHTML =
                        "Bs. " +
                        parseFloat((subTotal - descuentoAdicional) / 6.96)
                            .toFixed(5)
                            .toString();
                } else {
                    //bloque de validaciones
                    if (
                        elementGiftCard == "" ||
                        elementGiftCard == null ||
                        isNaN(elementGiftCard)
                    ) {
                        elementGiftCard = 0;
                    } else {
                        elementGiftCard = parseFloat(elementGiftCard);
                    }

                    let resultado =
                        subTotal - descuentoAdicional - elementGiftCard;

                    if (resultado < 0) {
                        M.toast({
                            html: "La resta de subtotal menos descuento adicional menos GiftCard no puede ser menor a cero!",
                            classes: "rounded",
                            displayLength: 2000,
                        });
                        return;
                    }

                    if (subTotal - descuentoAdicional < 0) {
                        M.toast({
                            html: "Número negativo en subtotal menos descuento adicional",
                            classes: "rounded",
                            displayLength: 2000,
                        });
                        return;
                    }

                    //bloque de insercio de datos
                    elementTotal.innerHTML =
                        "Bs. " + parseFloat(resultado).toFixed(5).toString();
                    elementSubTotal.innerHTML =
                        "Bs. " +
                        parseFloat(subTotal - descuentoAdicional)
                            .toFixed(5)
                            .toString();
                    document.getElementById("totalDolar").innerHTML =
                        "Bs. " +
                        parseFloat((subTotal - descuentoAdicional) / 6.96)
                            .toFixed(5)
                            .toString();
                }
                $("#showLoader").hide();
            }
        });
}
function cargarProducto() {
    $("#showLoader").show();
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
                    inputDescuento.id =
                        "inputDescuento" + data.content.codigo_producto;
                    inputDescuento.type = "number";
                    inputDescuento.min = "0.00001";
                    inputDescuento.step = "0.00001";
                    inputDescuento.value = "0.00000";
                    inputDescuento.onchange = function () {
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
                    c6.appendChild(inputDescuento);
                    c7.innerHTML =
                        "<span id='subtotal" +
                        data.content.codigo_producto +
                        "'>" +
                        parseFloat(
                            data.content.detalle_producto.precio_compra * 1
                        )
                            .toFixed(5)
                            .toString() +
                        "</span>";
                    c8.innerHTML = `<button type='button' class='btn btn-floating red' onclick='deleteRowCustom(${JSON.stringify(
                        data.content.codigo_producto
                    )})'><i id class='material-icons'>delete</i></button>`;
                    calcularSubTotal(data.content.codigo_producto);
                }
            } else {
                M.toast({
                    html: "Algo salio Mal!",
                    classes: "rounded",
                    displayLength: 2000,
                });
                $("#showLoader").hide();
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
                    /* document.getElementById("totalDolar").innerHTML =
                        "Bs. 0.00000"; */
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
function deleteRowCustom(codigo_producto) {
    let row = document.getElementById(codigo_producto);
    eliminarItem(codigo_producto);
    table_producto.deleteRow(row.rowIndex);
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
                /* document.getElementById("totalDolar").innerHTML =
                    "Bs. " + */
                parseFloat(data.content * 6.96)
                    .toFixed(5)
                    .toString();
            }
        });
}
