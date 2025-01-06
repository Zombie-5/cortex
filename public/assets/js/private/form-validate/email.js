
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
            antispam:
            {
                required: true,
                digits: true,
                range: [0, 1],
            },
            antimalware:
            {
                required: true,
                digits: true,
                range: [0, 1],
            },
            acesso_webmail:
            {
                required: true,
                digits: true,
                range: [0, 1],
            },
            parametrizacao_spf:
            {
                required: true,
                digits: true,
                range: [0, 1],
            },
            parametrizacao_dmarc:
            {
                required: true,
                digits: true,
                range: [0, 1],
            },
            configuracao:
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
