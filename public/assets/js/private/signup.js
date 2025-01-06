$(function()
{
    $('.signup-form').submit(function(event){
        event.preventDefault();

        if ($("#signup-form").valid())
        {
            $.ajax({
                url: $(this).attr('action'),
                type: "post",
                data: $(this).serialize(),
                dataType: "json",
                success: function(response)
                {
                    console.log(response);
                    if(response.success === true)
                    {
                        window.location = response.redirect;
                    }
                    else
                    {
                        var erro = "";
                        for(i in response.errors) erro += response.errors[i] + "<br>";
                        $('.messagebox').removeClass('d-none').html("<strong>Alerta!</strong><br>" + erro);
                    }
                }
            });
        }
    });
});
