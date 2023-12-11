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

// Input, Select, Textarea validations except submit button validation initialization
/* if ($(".users-edit").length > 0) {
      $("#accountForm, #infotabForm").validate({
        rules: {
          username: {
            required: true,
            minlength: 5
          },
          name: {
            required: true
          },
          email: {
            required: true
          },
          datepicker: {
            required: true
          },
          address: {
            required: true
          }
        },
        errorElement: 'div'
      });
      $("#infotabForm").validate({
        rules: {
          datepicker: {
            required: true
          },
          address: {
            required: true
          }
        },
        errorElement: 'div'
      });
    } */

let registrarProductoButton = document.getElementById(
    "registrarProductoButton"
);

let dosificacion = document.getElementById("dosificacion");
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
let precio_unitarioo = document.getElementById("precio_unitarioo");
let precio_unitario2 = document.getElementById("precio_unitario2");
let precio_unitario3 = document.getElementById("precio_unitario3");
let precio_unitario4 = document.getElementById("precio_unitario4");
let precio_paquete = document.getElementById("precio_paquete");
let precio_dolar = document.getElementById("precio_dolar");
let producto_id = document.getElementById("id_producto");

registrarProductoButton.addEventListener("click", function (event) {
    event.preventDefault();

    fetch(ruta_guardar_producto, {
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
            homologacion: homologacion.value,
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
            precio_unitarioo: precio_unitarioo.value,
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
});
