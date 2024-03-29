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
        'columnDefs': [{
            "orderable": false,
            "targets": [0, 8, 9]
        }]
    });
};
// on click selected users data from table(page named page-users-list)
// to store into local storage to get rendered on second page named page-users-view
$(document).on("click", "#users-list-datatable tr", function () {
    $(this).find("td").each(function () {
        usersDataArray.push($(this).text().trim())
    })

    localStorage.setItem("usersId", usersDataArray[1]);
    localStorage.setItem("usersUsername", usersDataArray[2]);
    localStorage.setItem("usersName", usersDataArray[3]);
    localStorage.setItem("usersVerified", usersDataArray[5]);
    localStorage.setItem("usersRole", usersDataArray[6]);
    localStorage.setItem("usersStatus", usersDataArray[7]);
})
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
        $(".users-view-status").toggleClass("badge-light-success badge-light-danger")
    }
    // update badge color on status change
    if ($(".users-view-status").text() === "Close") {
        $(".users-view-status").toggleClass("badge-light-success badge-light-warning")
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
        width: '100%'
    });
}
// users music select
if ($("#users-music-select2").length > 0) {
    $("#users-music-select2").select2({
        dropdownAutoWidth: true,
        width: '100%'
    });
}
// users movies select
if ($("#users-movies-select2").length > 0) {
    $("#users-movies-select2").select2({
        dropdownAutoWidth: true,
        width: '100%'
    });
}

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


let registrarPuntoVentaButton = document.getElementById('registrarPuntoVentaButton');
let nombre_punto_venta = document.getElementById('nombre_punto_venta');
let descripcion_punto_venta = document.getElementById('descripcion_punto_venta');
let tipo_punto_venta = document.getElementById('tipo_punto_venta');
let sucursal_id = document.getElementById('sucursal_id');


registrarPuntoVentaButton.addEventListener("click", function (event) {
    event.preventDefault();
    document.getElementById("loadingIndicator").style.display = "block";
    registrarPuntoVentaButton.style.display = "none";
    fetch(ruta_guardar_puntos_ventas, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-Token": csrfToken,
        },
        body: JSON.stringify({
            nombre_punto_venta: nombre_punto_venta.value,
            descripcion_punto_venta: descripcion_punto_venta.value,
            tipo_punto_venta: tipo_punto_venta.value,
            sucursal_id: sucursal_id.value,
        }),

    }).then(response => response.json())
        .then(data => {
            console.log(data);
            if (data.status == 200) {
                M.toast({
                    html: data.description,
                    classes: 'rounded', displayLength: 2000,
                    completeCallback: function () {
                        window.location.href = ruta_index_puntos_ventas
                    }
                })
            } else {
                M.toast({
                    html: data.description,
                    classes: 'rounded', displayLength: 3000, classes: 'blue lighten-1'
                })
            }
        }).catch(error => {
            M.toast({
                html: data.content.message,
                classes: 'rounded', displayLength: 3000, classes: 'blue lighten-1'
            })
        }).finally(() => {
            document.getElementById("loadingIndicator").style.display = "none";
            registrarPuntoVentaButton.style.display = "block";
        });
})




