/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function () {

    function endereco() {
// Limpa valores do formulário de cep.
        $("#rua").val("");
        $("#bairro").val("");
        $("#cidade").val("");
        $("#uf").val("");
        $("#ibge").val("");
    }

//Quando o campo cep perde o foco.
    $("#cep").blur(function () {

//Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');
        //Verifica se campo cep possui valor informado.
        if (cep != "") {

//Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;
            //Valida o formato do CEP.
            if (validacep.test(cep)) {

//Preenche os campos com "..." enquanto consulta webservice.
                $("#rua").val("...");
                $("#bairro").val("...");
                $("#cidade").val("...");
                $("#uf").val("...");
                $("#ibge").val("...");
                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
//                        $("#cep").val(dados.cep);
                        $("#rua").val(dados.logradouro);
                        $("#bairro").val(dados.bairro);
                        $("#cidade").val(dados.localidade);
                        $("#uf").val(dados.uf);
                        $("#ibge").val(dados.ibge);
                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        limpa_formulário_cep();
                        alert("CEP não encontrado.");
                    }
                });
            } //end if.
            else {
//cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
//cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    });


    $("#salario_inicial").keyup(function () {

        var valor = this
                , exec = function (v) {
                    v = v.replace(/\D/g, "");
                    v = new String(Number(v));
                    var len = v.length;
                    if (len <= 2)
                        v = v.replace(/(\d)/, '0.$1');
                    else if (len === 3)
                        v = v.replace(/(\d)/, "$1.");
                    else if (len === 4)
                        v = v.replace(/(\d{2})/, '$1.');
                    else if (len === 5)
                        v = v.replace(/(\d{3})/, '$1.');
                    else if (len === 6)
                        v = v.replace(/(\d{4})/, '$1.');
                    else if (len === 7)
                        v = v.replace(/(\d{5})/, '$1.');
                    else if (len >= 7) {
                        v = v.replace(/(\d){6}$/, '.$1');
                        v
                    }
                    return v;
                };
        setTimeout(function () {
            valor.value = exec(valor.value);
        }, 1);
    });

});


$(function () {

    function FormatData() {
        var data = $(this);

        data = data.length;
        alert(data);


    }



});



