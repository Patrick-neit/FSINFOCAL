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

$(".select2").select2({
    dropdownAutoWidth: true,
    width: '100%'
});


let asignarPrecioButton = document.getElementById('asignarPrecioButton');
let productos = document.querySelectorAll('.producto-checkbox');
let cliente_id= document.getElementById('cliente_id');
asignarPrecioButton.addEventListener("click", function (event) {
    event.preventDefault();

    let productosSeleccionados = [];

    productos.forEach(producto => {
        let productoID = producto.value;

        let precioA = document.querySelector(`input[name=precio_a_${productoID}]:checked`);
        let precioB = document.querySelector(`input[name=precio_b_${productoID}]:checked`);
        let precioC = document.querySelector(`input[name=precio_c_${productoID}]:checked`);
        let precioD = document.querySelector(`input[name=precio_d_${productoID}]:checked`);

        let precioData = {
            producto_id: productoID,
            precio_a: precioA ? 1 : 0,
            precio_b: precioB ? 1 : 0,
            precio_c: precioC ? 1 : 0,
            precio_d: precioD ? 1 : 0,
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
    }).then(response => response.json())
    .then(data => {
        if (data.status == 200) {
            M.toast({
                html: data.description,
                classes: 'rounded', displayLength: 2000,
                completeCallback: function () {
                    window.location.href = ruta_index_catalogo
                }
            })
        } else {
            M.toast({
                html: 'Algo salio Mal!',
                classes: 'rounded', displayLength: 3000, classes: 'blue lighten-1'
            })
        }
    });

});




