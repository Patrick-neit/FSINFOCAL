const csrfToken = document.head.querySelector(
    "[name~=csrf-token][content]"
).content;

let email = document.getElementById("email");
let password = document.getElementById("password");
let confirmPassword = document.getElementById("password-confirm");
let token = document.getElementById("token");

let updatePassword = document.getElementById("updatePassword");
$(document).ready(function () {
    updatePassword.addEventListener("click", function (event) {
        event.preventDefault();

        fetch(ruta_enviar_recuperacion, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-Token": csrfToken,
            },
            body: JSON.stringify({
                token: token.value,
                email: email.value,
                password: password.value,
                password_confirmation: confirmPassword.value,
            }),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.status == 200) {
                    M.toast({
                        html: data.description,
                        classes: "rounded",
                        displayLength: 3000,
                        completeCallback: function () {
                            window.location.href = ruta_index_dashboard;
                        },
                    });
                } else {
                    M.toast({
                        html: data.description,
                        classes: "rounded",
                        displayLength: 3000,
                        classes: "blue lighten-1",
                    });
                }
            })
            .catch((error) => {
                M.toast({
                    html: data.description,
                    classes: "rounded",
                    displayLength: 3000,
                    classes: "blue lighten-1",
                });
            });
    });
});
