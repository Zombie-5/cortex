$(document).ready(function() 
{
    toastr.options = {
        closeButton: true,             // Exibe o botão de fechar
        timeOut: 10000,                    // Define o tempo de exibição (0 = permanente)
        extendedTimeOut: 10000,            // Define o tempo adicional ao passar o mouse (0 = permanente)
        progressBar: true,             // Exibe uma barra de progresso
        positionClass: 'toast-bottom-right' // Define a posição do alerta na tela
    };

    function msgSuccess(msg)
    {
        toastr.success(msg, 'Sucesso');
    }

    function msgWarning(msg)
    {
        toastr.warning(msg, 'Aviso');
    }

    function msgError(msg)
    {
        toastr.error(msg, 'Erro');
    }

    window.msgSuccess = msgSuccess;
    window.msgWarning = msgWarning;
    window.msgError = msgError;
});