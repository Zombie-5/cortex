
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
            recurso:
            {
                required: true,
            },
            armazenamento:
            {
                required: true,
            },
            qtd_dominio:
            {
                required: true,
                digits: true,
            },
            qtd_base_dado:
            {
                required: true,
                digits: true,
            },
            qtd_email:
            {
                required: true,
                digits: true,
            },
            trafego:
            {
                required: true,
            },
            tipo:
            {
                required: true,
            },
        }
    })
});
