const csrfToken = document.head.querySelector(
    "[name~=csrf-token][content]"
).content;

let dosificacion = document.getElementById("dosificacion");
let codigo_producto_servicio = document.getElementById(
    "codigo_producto_servicio"
);
let unidad_medida = document.getElementById("unidad_medida");
let marca_id = document.getElementById("marca_id");
let categoria = document.getElementById("categoria");
let tipo_producto = document.getElementById("tipo_producto");
let sub_familia = document.getElementById("sub_familia");
let codigo_producto = document.getElementById("codigo_producto");
let nombre_producto = document.getElementById("nombre_producto");
let homologacion = document.getElementById("homologacion");
let modelo = document.getElementById("modelo");
let numero_serie = document.getElementById("numero_serie");
let numero_imei = document.getElementById("numero_imei");
let peso_unitario = document.getElementById("peso_unitario");
let codigo_barra = document.getElementById("codigo_barra");
let caracteristica = document.getElementById("caracteristica");
let stock_minimo = document.getElementById("stock_minimo");
let stock_actual = document.getElementById("stock_actual");
let almacen_id = document.getElementById("almacen_id");
let estado = document.getElementById("estado");

let precio_compra = document.getElementById("precio_compra");
let precio_unitarioo = document.getElementById("precio_unitario");
let precio_unitario2 = document.getElementById("precio_unitario2");
let precio_unitario3 = document.getElementById("precio_unitario3");
let precio_unitario4 = document.getElementById("precio_unitario4");
let precio_paquete = document.getElementById("precio_paquete");
let precio_dolar = document.getElementById("precio_dolar");
let producto_id = document.getElementById("id_producto");

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
    $("#formProducto").validate({
        errorLabelContainer: "#messageBox",
        wrapper: "li",
        rules: {
            dosificacion: 'required',
            unidad_medida: 'required',
            marca_id: 'required',
            categoria: 'required',
            tipo_producto: 'required',
            sub_familia: 'required',
            codigo_producto: 'required',
            nombre_producto: 'required',
            homologacion: 'required',
            modelo: 'required',
            numero_serie: 'required',
            numero_imei: 'required',
            peso_unitario: 'required',
            codigo_barra: 'required',
            caracteristica: 'required',
            stock_minimo: 'required',
            stock_actual: 'required',
            almacen_id: 'required',
            estado: 'required',
            precio_compra: 'required',
            precio_unitario: 'required',
            precio_unitario2: 'required',
            precio_unitario3: 'required',
            precio_unitario4: 'required',
            precio_paquete: 'required',
            precio_dolar: 'required',
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
            fetch(!producto_id.value ? ruta_guardar_producto : ruta_update_producto, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-Token": csrfToken,
                },
                body: JSON.stringify({
                    dosificacion: dosificacion.value,
                    unidad_medida: unidad_medida.value,
                    marca_id: marca_id.value,
                    categoria: categoria.value,
                    tipo_producto: tipo_producto.value,
                    sub_familia: sub_familia.value,
                    codigo_producto: codigo_producto.value,
                    nombre_producto: nombre_producto.value,
                    homologacion: homologacion.value ?? 1,
                    modelo: modelo.value,
                    numero_serie: numero_serie.value,
                    numero_imei: numero_imei.value,
                    peso_unitario: peso_unitario.value,
                    codigo_barra: codigo_barra.value,
                    caracteristica: caracteristica.value,
                    stock_minimo: stock_minimo.value,
                    stock_actual: stock_actual.value,
                    almacen_id: almacen_id.value,
                    estado: estado.value,

                    precio_compra: precio_compra.value,
                    precio_unitario: precio_unitarioo.value,
                    precio_unitario2: precio_unitario2.value,
                    precio_unitario3: precio_unitario3.value,
                    precio_unitario4: precio_unitario4.value,
                    precio_paquete: precio_paquete.value,
                    precio_dolar: precio_dolar.value,
                    producto_id: producto_id.value,
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
                                window.location.href = ruta_index_producto;
                            },
                        });
                    } else {
                        if (data.status == 422) {
                            data.content.forEach((contenido) =>
                                M.toast({
                                    html: contenido,
                                    classes: "rounded",
                                    displayLength: 3000,
                                    classes: "red lighten-1",
                                })
                            );
                        } else {
                            M.toast({
                                html: "Algo salio Mal!",
                                classes: "rounded",
                                displayLength: 3000,
                                classes: "blue lighten-1",
                            });
                        }
                    }
                });
        }
    });

})

function cargarActividad() {
    console.log(dosificacion.value);
    let homologacion_select = document.getElementById("homologacion");
    fetch(ruta_get_actividad, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-Token": csrfToken,
        },
        body: JSON.stringify({
            dosificacion_id: dosificacion.value,
        }),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.status == 200) {
                for (var i = 0; i < data.content.length; i++) {
                    var option = document.createElement("option");
                    option.value = data.content[i].codigo_producto;
                    option.textContent = data.content[i].descripcion_producto;
                    homologacion_select.appendChild(option);
                }
                M.FormSelect.init(homologacion_select);
            } else {
                if (data.status == 400) {
                    M.toast({
                        html: data.description,
                        classes: "rounded",
                        displayLength: 2000,
                    });
                } else {
                    M.toast({
                        html: "Algo salio Mal!",
                        classes: "rounded",
                        displayLength: 3000,
                        classes: "blue lighten-1",
                    });
                }
            }
        });
}

$(".select2").select2({
    dropdownAutoWidth: true,
    width: '100%',
});