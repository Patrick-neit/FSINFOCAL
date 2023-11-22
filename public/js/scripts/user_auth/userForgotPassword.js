const csrfToken = document.head.querySelector(
    "[name~=csrf-token][content]"
).content;

$(document).ready(function () {
    let email = document.getElementById("email");
    /* Logear User */
    let loginUserButton = document.getElementById("btn-recuperar");

    loginUserButton.addEventListener("click", function (event) {
        event.preventDefault();

        fetch(ruta_reset_user, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-Token": csrfToken,
            },
            body: JSON.stringify({
                email: email.value,
            }),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.status == 200) {
                    M.toast({
                        html: data.description,
                        classes: "rounded",
                        displayLength: 3000,
                        completeCallback: function () {},
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
