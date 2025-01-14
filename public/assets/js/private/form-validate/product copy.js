
$(document).ready(function()
{
    $("#frm_create").validate({
        rules:
        {
            name:
            {
                required: true,
            },
            desc:
            {
                required: true,
            },
            price:
            {
                required: true,
                digits: true,
            },
            income:
            {
                required: true,
                digits: true,
            },
            duration:
            {
                required: true,
                digits: true,
            },
        }
    })
});
