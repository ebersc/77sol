$(document).ready(function() {
    // Aplica a máscara dinâmica para CPF ou CNPJ
    $('#cpf_cnpj').on('focusout', function () {
        var inputLength = $(this).val().replace(/\D/g, '').length;

        if (inputLength <= 11) {
            $(this).mask('000.000.000-00');
        } else {
            $(this).mask('00.000.000/0000-00');
        }
    });
});

$("#btnSalvar").on('click', function(){
    if(validarNumeroDocumento() == false){
        alert("Informe um CPF ou CNPJ valido");
        return false;
    }

    let formData = new FormData($('#form_clientes')[0]);
    let documento = $('#cpf_cnpj').val().replace(/\D/g, '');
    let telefone = $('#telefone').val().replace(/\D/g, '');

    formData.append('cpf_cnpj', documento);
    formData.append('telefone', telefone);

    let url = '/cliente/salvar';

    $.ajax({
        type: 'POST',
        url: url,
        data: formData,
        processData: false,
        contentType: false
    }).done(function (resp){
        alert(resp.message);
        localtion.href = '/cliente'
    }).fail(function(err){
        console.log(err);
    });
});

function validarNumeroDocumento()
{
    let documento = $("#cpf_cnpj").val().replace(/[^\d]+/g, '');
    let tamanho_campo = documento.length;

    if(tamanho_campo < 11){
        return false;
    }

    if(tamanho_campo > 11){
        return validarCNPJ(documento);
    }else{
        return validarCPF(documento);
    }
}

function validarCPF(num_cpf) {
    let cpf = num_cpf.replace(/[^\d]+/g, '');

    if (cpf.length !== 11 || /^(\d)\1+$/.test(cpf)) {
        return false; // Verifica se o CPF tem 11 dígitos ou se todos os dígitos são iguais
    }
    let soma = 0, resto;

    // Valida o primeiro dígito verificador
    for (let i = 1; i <= 9; i++) {
        soma += parseInt(cpf.substring(i - 1, i)) * (11 - i);
    }
    resto = (soma * 10) % 11;
    if ((resto === 10) || (resto === 11)) {
        resto = 0;
    }
    if (resto !== parseInt(cpf.substring(9, 10))) {
        return false;
    }

    // Valida o segundo dígito verificador
    soma = 0;
    for (let i = 1; i <= 10; i++) {
        soma += parseInt(cpf.substring(i - 1, i)) * (12 - i);
    }
    resto = (soma * 10) % 11;
    if ((resto === 10) || (resto === 11)) {
        resto = 0;
    }
    return resto === parseInt(cpf.substring(10, 11));
}

function validarCNPJ(num_cnpj) {
    let cnpj = num_cnpj.replace(/[^\d]+/g, '');

    if (cnpj.length !== 14 || /^(\d)\1+$/.test(cnpj)) {
        return false; // Verifica se o CNPJ tem 14 dígitos ou se todos os dígitos são iguais
    }

    let tamanho = cnpj.length - 2;
    let numeros = cnpj.substring(0, tamanho);
    let digitos = cnpj.substring(tamanho);
    let soma = 0;
    let pos = tamanho - 7;

    // Valida o primeiro dígito verificador
    for (let i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2) pos = 9;
    }
    let resultado = soma % 11 < 2 ? 0 : 11 - (soma % 11);
    if (resultado !== parseInt(digitos.charAt(0))) {
        return false;
    }

    // Valida o segundo dígito verificador
    tamanho++;
    numeros = cnpj.substring(0, tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (let i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2) pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - (soma % 11);
    return resultado === parseInt(digitos.charAt(1));
}
