$(function()
{
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.frm_destroy').submit(function(event){
        event.preventDefault();
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
                    sessionStorage.setItem('sucessMessage', response.msg);
                    window.location.href = IndexRoute;
                    //msgSuccess(response.msg);
                }
                else
                {
                    var erro="";
                    for(i in response.errors) erro += response.errors[i] + "<br>";
                    msgError(erro);
                    //$('.messagebox').removeClass('d-none').html("<strong>Alerta!</strong><br>" + erro);
                }
            }
        });
    });
});
