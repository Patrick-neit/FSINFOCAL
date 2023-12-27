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

/* let asignarEmpresaButton = document.getElementById("asignarEmpresaButton");
let user_id = document.getElementById("user_id");
let empresas = document.querySelectorAll(".empresa-checkbox");

asignarEmpresaButton.addEventListener("click", function (event) {
    event.preventDefault();

    let empresasSeleccionadas = [];

    empresas.forEach((empresa) => {
        if (empresa.checked) {
            empresasSeleccionadas.push(empresa.value);
        }
    });

    fetch(ruta_asignar_empresa_usuario, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-Token": csrfToken,
        },
        body: JSON.stringify({
            user_id: user_id.value,
            empresas: empresasSeleccionadas,
        }),
    })
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
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
                    html: "Algo salio Mal!",
                    classes: "rounded",
                    displayLength: 3000,
                    classes: "blue lighten-1",
                });
            }
        });
}); */

let asignarPrecioButton = document.getElementById("asignarPrecioButton");
let productos = document.querySelectorAll(".producto-checkbox");
let cliente_id = document.getElementById("cliente_id");

asignarPrecioButton.addEventListener("click", function (event) {
    event.preventDefault();

    let productosSeleccionados = [];

    productos.forEach((producto) => {
        let productoID = producto.value;

        let precioA = document.querySelector(
            `input[name=precio_a_${productoID}]:checked`
        );
        let precioB = document.querySelector(
            `input[name=precio_b_${productoID}]:checked`
        );
        let precioC = document.querySelector(
            `input[name=precio_c_${productoID}]:checked`
        );
        let precioD = document.querySelector(
            `input[name=precio_d_${productoID}]:checked`
        );
        let precioE = document.querySelector(
            `input[name=precio_e_${productoID}]:checked`
        );
        let precioF = document.querySelector(
            `input[name=precio_f_${productoID}]:checked`
        );
        let precioG = document.querySelector(
            `input[name=precio_g_${productoID}]:checked`
        );

        let precioData = {
            producto_id: productoID,
            precio_a: precioA ? 1 : 0,
            precio_b: precioB ? 1 : 0,
            precio_c: precioC ? 1 : 0,
            precio_d: precioD ? 1 : 0,
            precio_e: precioE ? 1 : 0,
            precio_f: precioF ? 1 : 0,
            precio_g: precioG ? 1 : 0,
        };

        productosSeleccionados.push(precioData);
    });

    fetch(ruta_store_catalogos, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-Token": csrfToken,
        },
        body: JSON.stringify({
            cliente_id: cliente_id.value,
            productos: productosSeleccionados,
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
                        window.location.href = ruta_index_catalogo;
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

function blockCheck(id) {
    let check1 = document.getElementById("check_a_" + id);
    let check2 = document.getElementById("check_b_" + id);
    let check3 = document.getElementById("check_c_" + id);
    let check4 = document.getElementById("check_d_" + id);
    let check5 = document.getElementById("check_e_" + id);
    let check6 = document.getElementById("check_f_" + id);
    let check7 = document.getElementById("check_g_" + id);

    if (check1.checked) {
        check2.disabled = true;
        check3.disabled = true;
        check4.disabled = true;
        check5.disabled = true;
        check6.disabled = true;
        check7.disabled = true;
    } else if (check2.checked) {
        check1.disabled = true;
        check3.disabled = true;
        check4.disabled = true;
        check5.disabled = true;
        check6.disabled = true;
        check7.disabled = true;
    } else if (check3.checked) {
        check1.disabled = true;
        check2.disabled = true;
        check4.disabled = true;
        check5.disabled = true;
        check6.disabled = true;
        check7.disabled = true;
    } else if (check4.checked) {
        check1.disabled = true;
        check2.disabled = true;
        check3.disabled = true;
        check5.disabled = true;
        check6.disabled = true;
        check7.disabled = true;
    } else if (check5.checked) {
        check1.disabled = true;
        check2.disabled = true;
        check3.disabled = true;
        check4.disabled = true;
        check6.disabled = true;
        check7.disabled = true;
    } else if (check6.checked) {
        check1.disabled = true;
        check2.disabled = true;
        check3.disabled = true;
        check4.disabled = true;
        check5.disabled = true;
        check7.disabled = true;
    } else if (check7.checked) {
        check1.disabled = true;
        check2.disabled = true;
        check3.disabled = true;
        check4.disabled = true;
        check5.disabled = true;
        check6.disabled = true;
    } else {
        check1.disabled = false;
        check2.disabled = false;
        check3.disabled = false;
        check4.disabled = false;
        check5.disabled = false;
        check6.disabled = false;
        check7.disabled = false;
    }
}
