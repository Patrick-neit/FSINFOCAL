$(document).ready(function () {
    const titleModalUser = $("#title-modal-user")
    $('tbody').on('click', '#editarUser', function (e) {
        $("#formUser").validate().resetForm();
        $('input').removeClass('invalid');
        const user = $(this).data('user');
        user_id = user.id
        titleModalUser.html('Actualizar Usuario')
        $("#nombres").val(user.name);
        $("#apellidos").val(user.apellidos);
        $("#fecha_nacimiento").val(user.fecha_nacimiento);
        $("#ci").val(user.ci);
        $("#email").val(user.email);
        $("#departamento_id").val(user.departamento_id).change();
        $('#modalCrearUsuario').show();
    });
});