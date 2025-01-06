
$(document).ready(function()
{
    $("#frm_create").validate({
        rules:
        {
            nome_servico:
            {
                required: true,
            },
            duracao:
            {
                required: true,
            },
            preco_fornecedor:
            {
                required: true,
                digits: true,
            },
            preco_venda:
            {
                required: true,
                digits: true,
            },
            preco_renovacao_fornecedor:
            {
                required: true,
                digits: true,
            },
            preco_renovacao_venda:
            {
                required: true,
                digits: true,
            },
            preco_transferencia_fornecedor:
            {
                required: true,
                digits: true,
            },
            preco_transferencia_venda:
            {
                required: true,
                digits: true,
            },
        }
    })
});
