<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/admin.css" type="text/css">
        <link rel="stylesheet" href="css/reset.css" type="text/css">
        <title>Cadastro de Cliente</title>
    </head>

   
    <div class="container">

        <div class="form_create">

            <?php
            $Data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            if ($Data['SendDataCliente']):
                unset($Data['SendDataCliente']);

                $Create = new CadastraCliente;
                $Create->ExeCadastro($Data);

                if (!$Create->getResult()):
//                echo '<pre>';
//                var_dump($Create);
//                echo '</pre>';
                    WSErro($Create->getError()[0], $Create->getError()[1]);
                else:
                    WSErro($Create->getError()[0], $Create->getError()[1]);
                endif;
            else:

//        echo '<pre>';
//        var_dump($DataCliente);
//        echo '</pre>';
            endif;
            ?>

            <article>


                <form name="DataCliente" method="post" action="">

                    <br>
                    <div style="font-size: 2.3em; text-align: center"class="text-primary"><b>Cadastro de Cliente Pessoa Jurídica</b></div>
                    <a class="left btn btn-warning" href="main.php?url=system/cliente/create_pf.php">Cadastrar Pessoa Física</a>
                    <br>
                    <hr>
                    <!--Cadastro de Clientes-->

                    <div class="row">
                        <div class="form-group col-md-2">
                            <label for="cnpj_cpf"><b>CNPJ</b></label>
                            <input onkeypress="" type="text" class="form-control" name="cnpj_cpf" id="cnpj_cpf" placeholder="CNPJ" autocomplete="off" value="<?php if (isset($Data['cnpj_cpf'])) echo $Data['cnpj_cpf']; ?>">
                            <input type="hidden" name="tipo_pessoa" value="juridica">
                            <input type="hidden" name="dt_cadastro" value="<?php echo date('Y-m-d'); ?>">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="razao_social"><b>Razão Social</b></label>
                            <input type="text" class="form-control" name="razao_social" id="razao_social" placeholder="Razão Social" autocomplete="off" value="<?php if (isset($Data['razao_social'])) echo $Data['razao_social']; ?>">
                        </div>
                        <div class="form-group col-md-5">
                            <label for="nome_fantasia"><b>Noma Fantasia</b></label>
                            <input type="text" class="form-control" name="nome_fantasia" id="nome_fantasia" placeholder="Nome Fantasia" autocomplete="off" value="<?php if (isset($Data['nome_fantasia'])) echo $Data['nome_fantasia']; ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="insc_estadual"><b>Inscrição Estadual</b></label>
                            <input type="text" class="form-control" name="insc_estadual" id="insc_estadual" placeholder="Inscrição Estadual" autocomplete="off" value="<?php if (isset($Data['insc_estadual'])) echo $Data['insc_estadual']; ?>">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="insc_municipal"><b>Inscrição Municipal</b></label>
                            <input type="text" class="form-control" name="insc_municipal" id="insc_municipal" placeholder="Inscrição Municipal" autocomplete="off" value="<?php if (isset($Data['insc_municipal'])) echo $Data['insc_municipal']; ?>">
                        </div>

                        <div class="form-group col-md-2">
                            <label for="emitir_nota"><b>Nota Fiscal</b></label>
                            <select name="emitir_nota" id="emitir_nota" class="form-control">
                                <option selected></option>
                                <option value="sim">Sim</option>
                                <option value="nao">Não</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="status"><b>Status</b></label>
                            <select name="status" id="status" class="form-control">
                                <option value="ativo">Ativo</option>
                                <option value="inativo">Inativo</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="dia_entrega"><b>Dia da Entrega</b></label>
                            <select name="dia_entrega" id="dia_entrega" class="form-control" value="<?php if (isset($Data['dia_entrega'])) echo $Data['dia_entrega']; ?>">
                                <option selected></option>
                                <option value="segunda">Segunda Feira</option>
                                <option value="terca">Terça Feira</option>
                                <option value="quarta">Quarta Feira</option>
                                <option value="quinta">Quinta Feira</option>
                                <option value="sexta">Sexta Feira</option>
                                <option value="sabado">Sábado</option>
                                <option value="domingo">Domingo</option>
                            </select>
                        </div>    
                        <div class="form-group col-md-5">
                            <label for="vendedor"><b>Vendedor</b></label>
                            <select name="vendedor" id="vendedor" class="form-control">
                                <option selected=""></option>
                                <?php
                                $Read = new Read;
                                $Read->ExeRead("cargo as c inner join funcionario as f on c.id=f.cargo_id", "WHERE f.cargo_id=2 order by f.nome");
                                if ($Read->getResult()):
                                    foreach ($Read->getResult() as $Vendedor):
                                        ?>
                                        <option value="<?php echo $Vendedor['id']; ?>"><?php echo $Vendedor['nome']; ?></option>
                                    <?php endforeach; ?>
                                </select>

                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <input type="submit" class="btn btn-primary" value="Cadastrar" name="SendDataCliente" />
                        </div>
                    </div>


                    <hr>
                    <br>
                </form>
                <?php
                $DataEndereco = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                if ($DataEndereco['SendDataEndereco']):
                    unset($DataEndereco['SendDataEndereco']);

                    $CreateEndereco = new Endereco;
                    $CreateEndereco->ExeEndereco($DataEndereco);

                    if (!$CreateEndereco->getResult()):
//                echo '<pre>';
//                var_dump($CreateEndereco);
//                echo '</pre>';
                        WSErro($CreateEndereco->getError()[0], $CreateEndereco->getError()[1]);
                    else:
                        WSErro($CreateEndereco->getError()[0], $CreateEndereco->getError()[1]);
                    endif;
                else:

//        echo '<pre>';
//        var_dump($DataCliente);
//        echo '</pre>';
                endif;
                ?>

                <!--Cadastro de Endereços-->
                <form name="DataEndereco" method="post" action="">
                    <div style="font-size: 1.5em; width: 350px"class="text-primary"><b>Localização</b></div>
                    <br>
                    <hr>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="estado"><b>Tipo de Endereço</b></label>
                            <select name="estado" id="estado" class="form-control">
                                <option selected></option>
                                <option value="cobranca">Cobrança</option>
                                <option value="entrega">Entrega</option>
                                <option value="faturamento">Faturamento</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">                    
                        <div class="form-group col-md-2">
                            <label for="cep"><b>Cep</b></label>
                            <input type="text" class="form-control" name="cep" id="cep" autocomplete="off">
                        </div>

                        <div class="form-group col-md-5">
                            <label for="endereco"><b>Endereço</b></label>
                            <input type="text" class="form-control" name="endereco" id="endereco" autocomplete="off">
                        </div>

                        <div class="form-group col-md-1">
                            <label for="numero"><b>Número</b></label>
                            <input type="text" class="form-control" name="numero" id="numero" autocomplete="off">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="complemento"><b>Complemento</b></label>
                            <input type="text" class="form-control" name="complemento" id="complemento" autocomplete="off">
                        </div>
                    </div>
                    <div class="row">

                        <div class="form-group col-md-4">
                            <label for="bairro"><b>Bairro</b></label>
                            <input type="text" class="form-control" name="bairro" id="bairro" autocomplete="off">
                        </div>                   

                        <div class="form-group col-md-4">
                            <label for="cidade"><b>Cidade</b></label>
                            <input type="text" class="form-control" name="cidade" id="cidade" autocomplete="off">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="estado"><b>Estado</b></label>
                            <select name="estado" id="estado" class="form-control" autocomplete="off">
                                <option selected></option>
                                <option>...</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <input type="submit" class="btn btn-success" value="Salvar" name="SendDataEndereco" />
                        </div>
                    </div>
                    <hr>
                    <br>
                </form>



                <!--Cadastro de Telefones-->
                <form name="DataTelefone" method="post" action="">
                    <div style="font-size: 1.5em; width: 350px"class="text-primary"><b>Telefone</b></div>
                    <br>
                    <hr>
                    <div class="row">
                        <div class="form-group col-md-2">
                            <label for="tipo"><b>Tipo</b></label>
                            <select name="tipo" id="tipo" class="form-control" autocomplete="off">
                                <option selected></option>
                                <option value="celular">Celular</option>
                                <option value="fixo">Fixo</option>
                            </select>
                        </div>

                        <div class="form-group col-md-1">
                            <label for="ddd"><b>DDD</b></label>
                            <input type="text" class="form-control" name="ddd" id="ddd" autocomplete="off">
                        </div>

                        <div class="form-group col-md-2">
                            <label for="numero"><b>Número</b></label>
                            <input type="text" class="form-control" name="numero" id="numero" autocomplete="off">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="contato"><b>Nome do Contato</b></label>
                            <input type="text" class="form-control" id="contato" autocomplete="off">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <input type="submit" class="btn btn-success" value="Salvar" name="SendDataTelefone" />
                        </div>
                    </div>

                    <hr>
                    <br>

                </form>


                <!--Cadastro de Emails-->
                <form name="DataEmail" method="post" action="">
                    <div style="font-size: 1.5em; width: 350px;"class="text-primary"><b>E-mail</b></div>
                    <br>
                    <hr>
                    <div class="row">                    
                        <div class="form-group col-md-2">
                            <label for="email"><b>E-mail</b></label>
                            <input type="text" class="form-control" name="email" id="email" autocomplete="off">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="contato"><b>Contato</b></label>
                            <input type="text" class="form-control" name="contato" id="contato" autocomplete="off">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            <input type="submit" class="btn btn-success" value="Salvar" name="SendDataEmail" />
                        </div>
                    </div>
                </form>


            </article>

            <div class="clear"></div>
        </div> <!-- content home -->
    </div> <!-- content home -->
</html>
