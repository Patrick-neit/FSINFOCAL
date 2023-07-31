const csrfToken = document.head.querySelector(
    "[name~=csrf-token][content]"
).content;

$(document).ready(function () {
    /* Logear User */
    let loginUserButton = document.getElementById('loginUser');

    let email = document.getElementById('email');
    let password = document.getElementById('password');

    loginUserButton.addEventListener("click", function (event) {
        event.preventDefault();

    fetch(ruta_logear_user, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-Token": csrfToken,
        },
        body: JSON.stringify({
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
                       window.location.href = ruta_index_dashboard
                    }
                })
            } else {
                M.toast({
                    html: data.content.message,
                    classes: 'rounded', displayLength: 3000, classes: 'blue lighten-1'
                })
            }

        })
        .catch(error => {
            M.toast({
                html: data.content.message,
                classes: 'rounded', displayLength: 3000, classes: 'blue lighten-1'
            })
        });
});
});
