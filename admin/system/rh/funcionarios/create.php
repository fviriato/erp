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
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h1 class="panel-title">Cadastro de Funcionário</h1>
            </div>
            <div class="panel-body">
                <!--Panel content-->
                <div class="form_create">
                    <article>
                        <!------------------------Cadastro de Funcionários-->
                        <form name="dataFunc" method="post" action="">
                            <h3 class="text-primary">Dados Pessoais</h3>
                            <hr>
                            <div>
                                <?php
                                $DataFunc = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                                if (!empty($DataFunc['dataFunc'])):
                                    unset($DataFunc['dataFunc']);
                                    $DtNascimento = $DataFunc['dt_nascimento'];
                                    $DtAdmissao = $DataFunc['dt_admissao'];
                                    $DataFunc['dt_nascimento'] = date('Y-m-d', strtotime(str_replace('/', '-', $DataFunc['dt_nascimento'])));
                                    $DataFunc['dt_admissao'] = date('Y-m-d', strtotime(str_replace('/', '-', $DataFunc['dt_admissao'])));
//                                    echo '<pre>';
//                                    var_dump($DataFunc);
//                                    echo '</pre>';
                                    $Funcionario = new Funcionario;
                                    $Funcionario->ExeCreate($DataFunc);
                                    if (!$Funcionario->getResult()):
                                        WSErro($Funcionario->getError()[0], $Funcionario->getError()[1]);
                                    else:
                                        WSErro($Funcionario->getError()[0], $Funcionario->getError()[1]);
                                    endif;
                                else:

                                endif;
                                ?>
                            </div>
                            <div class="row">       
                                <div class="form-group col-md-3">
                                    <label for="pri_nome"><b>Primeiro Nome</b></label>
                                    <input type="text" class="form-control" name="pri_nome" id="pri_nome" placeholder="Primeiro Nome" autocomplete="off" value="<?php if (isset($DataFunc['pri_nome'])) echo $DataFunc['pri_nome']; ?>">
                                    <input type="hidden" name="dt_cadastro" value="<?php echo date('Y-m-d'); ?>">
                                    <input type="hidden" name="criado_por" value="1">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="meio_nome"><b>Nome do Meio</b></label>
                                    <input type="text" class="form-control" name="meio_nome" id="meio_nome" placeholder="Nome do Meio" autocomplete="off" value="<?php if (isset($DataFunc['meio_nome'])) echo $DataFunc['meio_nome']; ?>">
                                    <input type="hidden" name="dt_cadastro" value="<?php echo date('Y-m-d'); ?>">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="ult_nome"><b>Sobrenome</b></label>
                                    <input type="text" class="form-control" name="ult_nome" id="ult_nome" placeholder="Sobrenome" autocomplete="off" value="<?php if (isset($DataFunc['ult_nome'])) echo $DataFunc['ult_nome']; ?>">
                                    <input type="hidden" name="dt_cadastro" value="<?php echo date('Y-m-d'); ?>">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="dt_nascimento"><b>Data de Nascimento</b></label>
                                    <input type="text" class="form-control" name="dt_nascimento" id="dt_nascimento" data-mask="00/00/0000" maxlength="10" autocomplete="off" value="<?php if (isset($DataFunc['dt_nascimento'])) echo $DtNascimento; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="sexo_id"><b>Sexo</b></label>
                                    <select name="sexo_id" id="sexo_id" class="form-control" value="<?php if (isset($DataFunc['sexo_id'])) echo $DataFunc['sexo_id']; ?>">
                                        <option selected></option>
                                        <?php
                                        $sexo_post = $DataFunc['sexo_id'];
                                        $readSexo = new Read;
                                        $readSexo->FullRead("SELECT * FROM sexo order by sexo");
                                        if ($readSexo->getResult()):
                                            foreach ($readSexo->getResult() as $sexo):
                                                ?>
                                                <option value="<?php echo $sexo['id']; ?>" <?php if ($sexo_post == $sexo['id']) { ?> selected <?php } ?>><?php echo $sexo['sexo']; ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>    
                                <div class="form-group col-md-3">
                                    <label for="estado_civil_id"><b>Estado Civil</b></label>
                                    <select name="estado_civil_id" id="estado_civil_id" class="form-control" value="<?php if (isset($DataFunc['estado_civil_id'])) echo $DataFunc['estado_civil_id']; ?>">
                                        <option selected></option>                                        
                                        <?php
                                        $ec_post = $DataFunc['estado_civil_id'];
                                        $readEC = new Read;
                                        $readEC->FullRead("SELECT * FROM estado_civil order by id");
                                        if ($readEC->getResult()):
                                            foreach ($readEC->getResult() as $ec):
                                                ?>
                                                <option value="<?php echo $ec['id']; ?>" <?php if ($ec_post == $ec['id']) { ?> selected <?php } ?>><?php echo $ec['estado_civil']; ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>    
                                <div class="form-group col-md-3">
                                    <label for="dt_admissao"><b>Data Admissão</b></label>
                                    <input type="text" class="form-control" name="dt_admissao" id="dt_admissao" data-mask="00/00/0000" maxlength="10" autocomplete="off" value="<?php if (isset($DataFunc['dt_admissao'])) echo $DtAdmissao; ?>">

                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="cargo_id"><b>Cargo</b></label>
                                    <select name="cargo_id" id="cargo_id" class="form-control" value="<?php if (isset($DataFunc['cargo_id'])) echo $DataFunc['cargo_id']; ?>">
                                        <option selected></option>                               
                                        <?php
                                        $cargo_post = $DataFunc['cargo_id'];
                                        $readCargo = new Read;
                                        $readCargo->FullRead("SELECT * FROM cargo order by cargo");
                                        if ($readCargo->getResult()):
                                            foreach ($readCargo->getResult() as $cargo):
                                                ?>
                                                <option value="<?php echo $cargo['id']; ?>" <?php if ($cargo_post == $cargo['id']) { ?> selected <?php } ?>><?php echo $cargo['cargo']; ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="departamento_id"><b>Departamento</b></label>
                                    <select name="departamento_id" id="departamento_id" class="form-control" value="<?php if (isset($DataFunc['departamento_id'])) echo $DataFunc['departamento_id']; ?>">
                                        <option selected></option>                                        
                                        <option selected></option>                               
                                        <?php
                                        $dpto_post = $DataFunc['departamento_id'];
                                        $readDpto = new Read;
                                        $readDpto->FullRead("SELECT * FROM departamento order by departamento");
                                        if ($readDpto->getResult()):
                                            foreach ($readDpto->getResult() as $dpto):
                                                ?>
                                                <option value="<?php echo $dpto['id']; ?>" <?php if ($dpto_post == $dpto['id']) { ?> selected <?php } ?>><?php echo $dpto['departamento']; ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>    
                                <div class="form-group col-md-3">
                                    <label for="salario_inicial"><b>Salário Inicial (R$)</b></label>
                                    <input type="text" class="form-control" name="salario_inicial" id="salario_inicial" autocomplete="off" placeholder="Salário R$" value="<?php if (isset($DataFunc['salario_inicial'])) echo $DataFunc['salario_inicial']; ?>" maxlength="11">
                                </div>
                            </div>

                            <!--                            <div class="input-group">
                                                            <label for="money">Money</label>
                                                            <input type="text" class="cep" money.mask="00000-000" id="cep"/>
                                                        </div>-->


                            <div class="row">
                                <div class="form-group col-md-3">
                                    <!--<a class="btn btn-success" name="dataFunc" href="main.php?url=system/rh/funcionarios/create.php&acao=dataFunc">Salvar</a>-->

                                    <input type="submit" class="btn btn-success" value="Salvar" name="dataFunc" />
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>


        <!-----------------------------------------------CADASTRO DE ENDEREÇOS------------------------------------------------------------>


        <div class="panel panel-primary">
            <div class="panel-heading">
                <h1 class="panel-title">Localização</h1>
            </div>
            <div class="panel-body">
                <!--Panel content-->
                <div id="endereco">
                    
                    <div class="row">
                        <div class="form-group col-md-7">
                            <label for="func"><b>Funcionário</b></label>
                            <select name="func" id="func" class="form-control" value="<?php ?>">
                                <option selected></option>                               
                                <?php
                                $a = $Funcionario->getResult();                                
                                var_dump($a);
                                
                                
                                $readFunc = new Read;
                                $readFunc->FullRead("SELECT * FROM funcionario order by pri_nome asc");
                                if ($readFunc->getResult()):
                                    foreach ($readFunc->getResult() as $func):
                                        ?>
                                <option value="<?php echo $func['id']; ?>" <?php if ($cargo_post == $cargo['id']) { ?> selected <?php } ?>><?php echo $func['pri_nome'] ." ". $func['meio_nome']." ".$func['ult_nome'] ."    |    Data Nasc." . date('d/m/Y', strtotime(str_replace("-", "/", $func['dt_nascimento']))) ; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>

                    </div>

                    <!--Cadastro de Endereços-->
                    <form name="DataEndereco" method="POST" action="">
                        <h3 class="text-primary">Endereço</h3>
                        <hr>

                        <div>
                            <?php
                            $Endereco = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                            
                            if ($Endereco['DataEndereco']):
                                unset($Endereco['DataEndereco']);

                                $CreateEndereco = new Endereco;
                                $CreateEndereco->ExeCreate($Endereco);

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
                                <label for="cep"><b>Cep</b></label>
                                <input type="text" class="form-control" name="cep" id="cep" autocomplete="off" onblur="endereco" maxlength="8">
                            </div>

                            <div class="form-group col-md-5">
                                <label for="rua"><b>Rua</b></label>
                                <input type="text" class="form-control" name="rua" id="rua" autocomplete="off">
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

                            <div class="form-group col-md-2">
                                <label for="uf"><b>Estado</b></label>
                                <input type="text" class="form-control" name="uf" id="uf" autocomplete="off" maxlength="2">
                            </div>


                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <input type="submit" class="btn btn-success" value="Salvar" name="DataEndereco" />
                            </div>
                        </div>
                    </form>
                </div>
            </div> 
        </div> 


        <!-----------------------------------------------CADASTRO DE TELEFONES------------------------------------------------------------>


        <div class="panel panel-primary">
            <div class="panel-heading">
                <h1 class="panel-title">Contatos</h1>
            </div>
            <div class="panel-body">
                <!--Panel content-->
                <div id="endereco">

                    <!--Cadastro de Endereços-->
                    <form name="DataEndereco" method="post" action="">
                        <h3 class="text-primary">Telefone</h3>
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

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h1 class="panel-title">Documentos</h1>
            </div>
            <div class="panel-body">
                <!--Panel content-->
                <div id="endereco">

                    <!--Cadastro de Documentos-->
                    <form name="DataEndereco" method="post" action="">
                        <h3 class="text-primary">Documentos</h3>
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
                                <label for="tipo"><b>Documento</b></label>
                                <select name="tipo" id="tipo" class="form-control" autocomplete="off">
                                    <option selected></option>
                                    <option value="rg">RG</option>
                                    <option value="cpf">CPF</option>
                                    <option value="habilitacao">Habilitação</option>
                                    <option value="ctps">Carteira Profisional</option>
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="numero"><b>Número Documento</b></label>
                                <input type="text" class="form-control" name="numero" id="numero" autocomplete="off">
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
    </div>
    <script type="text/javascript"></script>
    <script src="js/jquery.js"></script>
    <script src="js/jquery.mask.js"></script>
    <script src="js/jquery.mask.min.js"></script>
    <script src="js/funcoes.js"></script>

</html>
