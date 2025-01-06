
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
            armazenamento:
            {
                required: true,
            },
            qtd_ram:
            {
                required: true,
                digits: true,
            },
            qtd_vcpu:
            {
                required: true,
                digits: true,
            },
            uplink:
            {
                required: true,
            },
            tipo_backup:
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
