const csrfToken = document.head.querySelector(
    "[name~=csrf-token][content]"
).content;

$(document).ready(function () {

    /* Registrar User */
let registrarUserButton = document.getElementById('registrarUser');

let name = document.getElementById('name');
let email = document.getElementById('email');
let password = document.getElementById('password');

registrarUserButton.addEventListener("click", function (event) {
    event.preventDefault();
    fetch(ruta_registrar_user, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-Token": csrfToken,
        },
        body: JSON.stringify({
            name: name.value,
            email: email.value,
            password: password.value,


        }),
    })
        .then(response => response.json())
        .then(data => {
            if (data.status == 200) {
                M.toast({
                    html: data.description,
                    classes: 'rounded', displayLength: 3000,
                    completeCallback: function () {
                       window.location.href = ruta_index_login
                    }
                })
            } else {
                M.toast({
                    html: data.description.message,
                    classes: 'rounded', displayLength: 3000, classes: 'blue lighten-1'
                })
            }

        })
        .catch(error => {
            console.log(error);
        });
});
});
