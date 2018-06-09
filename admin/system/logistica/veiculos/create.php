<?php
$acao = filter_input_array(INPUT_GET, (string) 'acao', FILTER_DEFAULT);

//echo '<pre>';
//var_dump($acao);
//echo '</pre>';
//
//if ($acao = 'dataCliente'):
//    echo 'Dados de Cliente Ok';
//endif;
?>
<!DOCTYPE html>


<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/admin.css" type="text/css">
        <link rel="stylesheet" href="css/reset.css" type="text/css">
        <title></title>
    </head>
       

    <div class="container-fluid">
        
        <div class="statistcs">
            <div class="totalcliente size btn-info">
                <span style="text-decoration: underline; align-content: center; font-size: 13px; font-weight: bold; font-family: 'Arial'" class="center">Clientes Cadastrados</span><br/>
                <h2> <?php
                $ReadCli = new Read;
                $ReadCli->FullRead("SELECT count(razao_social) AS total FROM cliente");                
                if($ReadCli->getResult()){
                    foreach($ReadCli->getResult() as $TotalCliente):
                    $TotalCliente['total']++;
                endforeach;
                }                
                echo  $TotalCliente['total']-1;                
                ?></h2>
            </div>

            <div class="totalcliente size btn-danger">
                <span style="text-decoration: underline; align-content: center; font-size: 13px; font-weight: bold; font-family: 'Arial'" class="center">Não Compra + de 3 meses</span>
                <h2> <?php
                $ReadCli2 = new Read;
                $ReadCli2->FullRead("SELECT count(razao_social) AS total FROM cliente");                
                if($ReadCli2->getResult()){
                    foreach($ReadCli2->getResult() as $TotalCliente):
                    $TotalCliente['total']++;
                endforeach;
                }                
                echo  $TotalCliente['total']-19;                
                ?></h2>
            </div>
        </div>
        
        

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h1 class="panel-title">Cadastro de Cliente</h1>
            </div>
            <div class="panel-body">
                <!--Panel content-->
                <div class="row">
                    <div class="form-group col-md-2 j_tipo right">
                        <label for="tipo">Tipo</label>
                        <select name="tipo" id="tipo" class="form-control j_tpCliente">
                            <option selected></option>
                            <option value="fisica">Física</option>
                            <option value="juridica">Jurídica</option>
                        </select>
                    </div>
                </div>
                <div class="form_create">

                    <article>

                        <form class="j_juridica" name="DataCliente" method="post" action="">
                            <div style="font-size: 1.5em;"class="text"><span class="alert-info"><b>Pessoa Jurídica</b></span></div>
                            <hr>
                            <div>
                                <?php
                                $Data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                                if ($Data['SendDataCliente']):
                                    unset($Data['SendDataCliente']);
                                    $Create = new CadastraCliente;
                                    $Create->ExeCadastro($Data);

                                    if (!$Create->getResult()):
                                        WSErro($Create->getError()[0], $Create->getError()[1]);
                                    else:
                                        WSErro($Create->getError()[0], $Create->getError()[1]);
                                    endif;
                                else:

                                endif;
                                ?>
                            </div>
                            <br>
                            <!--Cadastro de Clientes Pessoa Jurídica-->

                            <div class="row">
                                <div class="form-group col-md-3">
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
                                <div class="form-group col-md-5">
                                    <label for="insc_estadual"><b>Inscrição Estadual</b></label>
                                    <input type="text" class="form-control" name="insc_estadual" id="insc_estadual" placeholder="Inscrição Estadual" autocomplete="off" value="<?php if (isset($Data['insc_estadual'])) echo $Data['insc_estadual']; ?>">
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="insc_municipal"><b>Inscrição Municipal</b></label>
                                    <input type="text" class="form-control" name="insc_municipal" id="insc_municipal" placeholder="Inscrição Municipal" autocomplete="off" value="<?php if (isset($Data['insc_municipal'])) echo $Data['insc_municipal']; ?>">
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

                                    <a class="btn btn-success" href="main.php?url=system/cliente/create.php&acao=dataCliente">Salvar</a>

                                        <!--<input type="submit" class="btn btn-primary" value="Cadastrar" name="SendDataCliente" />-->
                                </div>
                            </div>
                        </form>


                        <!--Cadastro de Clientes Pessoa Física-->


                        <form class="j_fisica" name="DataCliente" method="post" action="">
                            <div style="font-size: 1.5em;"class="text"><span class="alert-info"><b>Pessoa Física</b></span></div>
                            <hr>
                            <div>
                                <?php
                                $Data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                                if ($Data['SendDataCliente']):
                                    unset($Data['SendDataCliente']);

                                    $Create = new CadastraCliente;
                                    $Create->ExeCadastro($Data);

                                    if (!$Create->getResult()):
                                        WSErro($Create->getError()[0], $Create->getError()[1]);
                                    else:
                                        WSErro($Create->getError()[0], $Create->getError()[1]);
                                    endif;
                                else:

                                endif;
                                ?>
                            </div>
                            <br>
                            <!--Cadastro de Clientes-->

                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="cnpj_cpf"><b>CPF</b></label>
                                    <input onkeypress="" type="text" class="form-control" name="cnpj_cpf" id="cnpj_cpf" placeholder="CPF" autocomplete="off" value="<?php if (isset($Data['cnpj_cpf'])) echo $Data['cnpj_cpf']; ?>">
                                    <input type="hidden" name="cnpj_cpf" value="juridica">
                                    <input type="hidden" name="dt_cadastro" value="<?php echo date('Y-m-d'); ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="razao_social"><b>Nome</b></label>
                                    <input type="text" class="form-control" name="razao_social" id="razao_social" placeholder="Nome do Cliente" autocomplete="off" value="<?php if (isset($Data['razao_social'])) echo $Data['razao_social']; ?>">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="nome_fantasia"><b>Data Nascimento</b></label>
                                    <input type="date" class="form-control" name="nome_fantasia" id="nome_fantasia" placeholder="Nome Fantasia" autocomplete="off" value="<?php if (isset($Data['nome_fantasia'])) echo $Data['nome_fantasia']; ?>">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label for="status"><b>Status</b></label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="ativo">Ativo</option>
                                        <option value="inativo">Inativo</option>
                                    </select>
                                </div>

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
                                <div class="form-group col-md-4">
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

                                    <a class="btn btn-success j_InserirFisica" href="main.php?url=system/cliente/create.php&acao=dataCliente">Salvar</a>

                                        <!--<input type="submit" class="btn btn-primary" value="Cadastrar" name="SendDataCliente" />-->
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>


        <!-----------------------------------------------CADASTRO DE ENDEREÇOS------------------------------------------------------------>


        <div class="panel panel-primary j_localizacao">
            <div class="panel-heading">
                <h1 class="panel-title">Localização</h1>
            </div>
            <div class="panel-body">
                <!--Panel content-->
                <div id="endereco">

                    <!--Cadastro de Endereços-->
                    <form class="j_endereco" name="DataEndereco" method="post" action="">
                        <div style="font-size: 1.5em; width: 350px"class="text-primary"><span class="alert-info"><b>Cadastro de Endereço</b></span></div>
                        <hr>

                        <div>
                            <?php
                            $DataEndereco = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                            if ($DataEndereco['SendDataEndereco']):
                                unset($DataEndereco['SendDataEndereco']);

                                $CreateEndereco = new Endereco;
                                $CreateEndereco->ExeEndereco($DataEndereco);

                                if (!$CreateEndereco->getResult()):

                                    WSErro($CreateEndereco->getError()[0], $CreateEndereco->getError()[1]);
                                else:
                                    WSErro($CreateEndereco->getError()[0], $CreateEndereco->getError()[1]);
                                endif;
                            else:
                            endif;
                            ?>
                        </div>


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

                            <div class="form-group col-md-2">
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
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <input type="submit" class="btn btn-success j_InserirEndereco" value="Salvar" name="SendDataEndereco" />
                            </div>
                        </div>
                    </form>
                </div>
            </div> 
        </div> 


        <!-----------------------------------------------CADASTRO DE TELEFONES------------------------------------------------------------>


        <div class="panel panel-primary j_telefone">
            <div class="panel-heading">
                <h1 class="panel-title">Telefone</h1>
            </div>
            <div class="panel-body">
                <!--Panel content-->
                <div id="endereco">

                    <!--Cadastro de Endereços-->
                    <form class="j_endereco" name="DataEndereco" method="post" action="">
                        <div style="font-size: 1.5em; width: 350px"class="text-primary"><span class="alert-info"><b>Cadastro de Telefones</b></span></div>
                        <hr>

                        <div>
                            <?php
                            $DataEndereco = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                            if ($DataEndereco['SendDataEndereco']):
                                unset($DataEndereco['SendDataEndereco']);

                                $CreateEndereco = new Endereco;
                                $CreateEndereco->ExeEndereco($DataEndereco);

                                if (!$CreateEndereco->getResult()):

                                    WSErro($CreateEndereco->getError()[0], $CreateEndereco->getError()[1]);
                                else:
                                    WSErro($CreateEndereco->getError()[0], $CreateEndereco->getError()[1]);
                                endif;
                            else:
                            endif;
                            ?>
                        </div>



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
                    </form>
                </div> <!-- content home -->
            </div> <!-- content home -->
        </div> <!-- content home -->

        <!-----------------------------------------------CADASTRO DE EMAIS------------------------------------------------------------>


        <div class="panel panel-primary j_email">
            <div class="panel-heading">
                <h1 class="panel-title">E-mails</h1>
            </div>
            <div class="panel-body">
                <!--Panel content-->
                <div id="endereco">

                    <!--Cadastro de Endereços-->
                    <form class="j_endereco" name="DataEndereco" method="post" action="">
                        <div style="font-size: 1.5em; width: 350px"class="text-primary"><span class="alert-info"><b>Cadastro de E-mails</b></span></div>
                        <hr>

                        <div>
                            <?php
                            $DataEndereco = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                            if ($DataEndereco['SendDataEndereco']):
                                unset($DataEndereco['SendDataEndereco']);

                                $CreateEndereco = new Endereco;
                                $CreateEndereco->ExeEndereco($DataEndereco);

                                if (!$CreateEndereco->getResult()):

                                    WSErro($CreateEndereco->getError()[0], $CreateEndereco->getError()[1]);
                                else:
                                    WSErro($CreateEndereco->getError()[0], $CreateEndereco->getError()[1]);
                                endif;
                            else:
                            endif;
                            ?>
                        </div>

                        <div class="row">                    
                            <div class="form-group col-md-6">
                                <label for="email"><b>E-mail</b></label>
                                <input type="text" class="form-control" name="email" id="email" autocomplete="off">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="contato"><b>Nome do Contato</b></label>
                                <input type="text" class="form-control" name="contato" id="contato" autocomplete="off">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-3">
                                <input type="submit" class="btn btn-success" value="Salvar" name="SendDataEmail" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            </article>

            <!--<div class="clear"></div>-->
        </div> <!-- content home -->

    </div>
    <script src="js/jquery.js"></script>
    <script src="js/cliente.js"></script>

</html>
