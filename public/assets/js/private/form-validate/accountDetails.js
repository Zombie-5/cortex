$(document).ready(function() 
{
    $("#frm_edit").validate({
        rules: {
            inputPhone: {
                digits: true,
                minlength: 9,
                maxlength: 9
            },
            inputDob: {
                date: true
            },
            inputNif: {
                digits: true,
                minlength: 9,
                maxlength: 9
            },
            inputPhoneEmpresa: {
                digits: true,
                minlength: 9,
                maxlength: 9
            },
            
        }
    });
});
