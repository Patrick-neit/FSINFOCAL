$(document).ready(function () {
    $('select[required]').css({
        display: 'inline',
        position: 'absolute',
        float: 'left',
        padding: 0,
        margin: 0,
        border: '1px solid rgba(255,255,255,0)',
        height: 0,
        width: 0,
        top: '2em',
        left: '3em'
    });
    $("#formDosificacion").validate({
        errorLabelContainer: "#messageBox",
        wrapper: "li",
        rules: {
            tipo_factura_id: 'required',
            documento_sector_id: 'required',
            nro_inicio_factura: 'required',
            nro_fin_factura: 'required',
            empresa_cafc: 'required',
        },
        errorClass: 'invalid',
        validClass: "valid",
        errorPlacement: function (label, element) {
            if (element.hasClass('select2 browser-default')) {
                label.insertAfter(element.next('.select2-container')).addClass('mt-2 text-danger');
                select2label = label
            } else {
                label.addClass('mt-2 text-danger');
                label.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            storeDosificacion()
        }
    });
})