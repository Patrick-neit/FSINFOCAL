$(document).ready(function () {
    const titleModalUser = $("#title-modal-user")
    $('#crearUser').on('click', function (e) {
        $("#formUser").validate().resetForm();
        $('input').removeClass('invalid');
        user_id = null
        titleModalUser.html('Crear Usuario')
        $("#nombres").val('');
        $("#apellidos").val('');
        $("#fecha_nacimiento").val('');
        $("#ci").val('');
        $("#email").val('');
        $("#departamento_id").val('');
    });
});