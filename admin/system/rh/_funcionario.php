<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>

        <!-- Adicionando JQuery -->        
        <script src="js/jquery.js"></script>

        <!-- Adicionando Javascript -->
        <script type="text/javascript" >

            $(document).ready(function () {

                function limpa_formulário_cep() {
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
            });
        </script>


        <script type="text/javascript">
            /* Máscaras ER */
            function mascara(o, f) {
                v_obj = o;
                v_fun = f;
                setTimeout("execmascara()", 1);
            }
            function execmascara() {
                v_obj.value = v_fun(v_obj.value);
            }
            ;
            function mtel(v) {
                v = v.replace(/\D/g, ""); //Remove tudo o que não é dígito
                v = v.replace(/^(\d{2})(\d)/g, "($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
                v = v.replace(/(\d)(\d{4})$/, "$1 - $2"); //Coloca hífen entre o quarto e o quinto dígitos
                return v;
            }
            function id(el) {
                return document.getElementById(el);
            }
            window.onload = function () {
                id('telefone').onkeyup = function () {
                    mascara(this, mtel);
                };
            };
        </script>



    </head>
    <body>

        <div class="container-fluid">
            <div style="font-size: 2.3em; text-align: center"class="text-primary">
                <b>Cadastro de Funcionários</b>
            </div>
            <hr>

            <div class="row">
                <div class="form-group col-md-7">
                    <label for="nome"><b>Nome</b></label>
                    <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome Completo do Funcionário" autocomplete="off" value="<?php if (isset($Data['nome'])) echo $Data['nome']; ?>">
                    <input type="hidden" name="tipo_pessoa" value="juridica">
                    <input type="hidden" name="dt_cadastro" value="<?php echo date('Y-m-d'); ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="dt_nascimento"><b>Data Nascimento</b></label>
                    <input type="date" class="form-control" name="dt_nascimento" id="dt_nascimento" autocomplete="off" value="<?php if (isset($Data['dt_nascimento'])) echo $Data['dt_nascimento']; ?>">
                </div>
            </div>

            <div class="row">

                <div class="form-group col-md-2">
                    <label for="sexo"><b>Sexo</b></label>
                    <select name="sexo" id="sexo" class="form-control">
                        <option selected></option>
                        <option value="feminino">Feminino</option>
                        <option value="masculino">Masculino</option>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="estado_civil"><b>Estado Civil</b></label>
                    <select name="estado_civil" id="estado_civil" class="form-control">
                        <option selected></option>
                        <option value="casado">Casado</option>
                        <option value="solteiro">Solteiro</option>
                        <option value="divorciado">Divorciado</option>
                        <option value="outros">Outros</option>
                    </select>
                </div>

                <div class="form-group col-md-3">
                    <label for="dt_admissao"><b>Data Admissão</b></label>
                    <input type="date" class="form-control" name="dt_admissao" id="dt_admissao" autocomplete="off" value="<?php if (isset($Data['dt_admissao'])) echo $Data['dt_admissao']; ?>">
                </div>
                <div class="form-group col-md-2">
                    <label for="salario_inicial"><b>Salário</b></label>
                    <input type="text" class="form-control" name="salario_inicial" id="salario_inicial" placeholder="R$" autocomplete="off" value="<?php if (isset($Data['salario_inicial'])) echo $Data['salario_inicial']; ?>">
                    <input type="hidden" name="dt_cadastro" value="<?php echo date('Y-m-d'); ?>">
                </div>
            </div>


            <div class="row">


                <div class="form-group col-md-3">
                    <label for="departamento"><b>Departamento</b></label>
                    <select name="departamento" id="departamento" class="form-control">
                        <option selected=""></option>
                        <?php
                        $Read = new Read;
                        $Read->ExeRead("departamento order by departamento asc");
                        if ($Read->getResult()):
                            foreach ($Read->getResult() as $Departamento):
                                ?>
                                <option value="<?php echo $Departamento['id']; ?>"><?php echo $Departamento['departamento']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    <?php endif; ?>
                </div>

                <div class="form-group col-md-3">
                    <label for="cargo"><b>Cargo</b></label>
                    <select name="cargo" id="cargo" class="form-control">
                        <option selected=""></option>
                        <?php
                        $Readc = new Read;
                        $Readc->ExeRead("cargo order by descricao asc");
                        if ($Readc->getResult()):
                            foreach ($Readc->getResult() as $Cargo):
                                ?>
                                <option value="<?php echo $Cargo['id']; ?>"><?php echo $Cargo['descricao']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    <?php endif; ?>
                </div>
            </div>

            <hr>

            <div style="font-size: 2.3em; text-align: center"class="text-primary">
                <b>Endereço</b>
            </div>    
            <hr>


            <div class="row">
                <div class="form-group col-md-2">
                    <label for="cep"><b>CEP</b></label>
                    <input type="text" class="form-control" name="cep" id="cep"  autocomplete="off" value="<?php if (isset($Data['nome'])) echo $Data['nome']; ?>" maxlength="8">
                </div>
                <div class="form-group col-md-5">
                    <label for="rua"><b>Rua</b></label>
                    <input type="text" class="form-control" name="rua" id="rua" autocomplete="off" value="<?php if (isset($Data['nome'])) echo $Data['nome']; ?>">
                    <input type="hidden" name="dt_cadastro" value="<?php echo date('Y-m-d'); ?>">
                </div>
                <div class="form-group col-md-2">
                    <label for="numero"><b>Número</b></label>
                    <input type="text" class="form-control" name="numero" id="numero" autocomplete="off" value="<?php if (isset($Data['nome'])) echo $Data['nome']; ?>">
                    <input type="hidden" name="dt_cadastro" value="<?php echo date('Y-m-d'); ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="complemento"><b>Complemento</b></label>
                    <input type="text" class="form-control" name="complemento" id="complemento" autocomplete="off" value="<?php if (isset($Data['dt_nascimento'])) echo $Data['dt_nascimento']; ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-3">
                    <label for="bairro"><b>Bairro</b></label>
                    <input type="text" class="form-control" name="bairro" id="bairro" autocomplete="off" value="<?php if (isset($Data['dt_nascimento'])) echo $Data['dt_nascimento']; ?>">
                </div>

                <div class="form-group col-md-4">
                    <label for="cidade"><b>Cidade</b></label>
                    <input type="text" class="form-control" name="cidade" id="cidade"autocomplete="off" value="<?php if (isset($Data['nome'])) echo $Data['nome']; ?>" maxlength="8">
                </div>
                <div class="form-group col-md-2">
                    <label for="uf"><b>UF</b></label>
                    <input type="text" class="form-control" name="uf" id="uf" autocomplete="off" value="<?php if (isset($Data['nome'])) echo $Data['nome']; ?>">
                </div>
                <div class="form-group col-md-2">
                    <label for="ibge"><b>IBGE</b></label>
                    <input type="text" class="form-control" name="ibge" id="ibge" autocomplete="off" value="<?php if (isset($Data['nome'])) echo $Data['nome']; ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-3">
                    <a class="btn btn-primary" href="main.php?url=system/cliente/create.php&acao=dataCliente">Cadastrar</a>
                </div>
            </div>

            <hr>
            <div style="font-size: 2.3em; text-align: center"class="text-primary">
                <b>Telefone</b>
            </div>    
            <hr>

            <div class="form-group col-md-3">
                <label for="telefone"><b>Telefone Fixo</b></label>
                <input type="text" class="form-control" name="telefone" id="telefone" maxlength="16" />
            </div>
            <div class="form-group col-md-3">
                <label for="celular"><b>Telefone Celular</b></label>
                <input type="text" class="form-control" name="telefone" id="telefone" maxlength="16" />
            </div>
            
        </div>





    </body>
</html>
