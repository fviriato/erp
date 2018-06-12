<!--FORMULÁRIO DE CADASTRO DE FUNCIONÁRIOS-->
<form class="j_PersonalData" name="dataFunc" method="post" action="">
    <br>
    <div>
        <?php
        $DataFunc = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($DataFunc['dataFunc'])):
            unset($DataFunc['dataFunc']);

            if ($DtNascimento = $DataFunc['dt_nascimento']):
                $DataFunc['dt_nascimento'] = date('Y-m-d', strtotime(str_replace('/', '-', $DataFunc['dt_nascimento'])));
            else:
                $DtNascimento = $DataFunc['dt_nascimento'];
            endif;

            if ($DtAdmissao = $DataFunc['dt_admissao']):
                $DataFunc['dt_admissao'] = date('Y-m-d', strtotime(str_replace('/', '-', $DataFunc['dt_admissao'])));
            else:
                $DtAdmissao = $DataFunc['dt_admissao'];
            endif;

            echo '<pre>';
            var_dump($DataFunc);
            echo '</pre>';

            $Funcionario = new Funcionario;
            $Funcionario->ExeCreate($DataFunc);
            if (!$Funcionario->getResult()):
                WSErro($Funcionario->getError()[0], $Funcionario->getError()[1]);
            else:
                WSErro($Funcionario->getError()[0], $Funcionario->getError()[1]);
                $Funcionario->FuncionarioId;
            endif;
        else:

        endif;
        ?>

        <div class="trigger-box"></div>

    </div>
    <div class="row">       
        <div class="form-group col-md-3">
            <label for="pri_nome"><b>Primeiro Nome</b></label>
            <input type="text" class="form-control" name="pri_nome" id="pri_nome" autocomplete="off" value="<?php if (isset($DataFunc['pri_nome'])) echo $DataFunc['pri_nome']; ?>">
            <input type="hidden" name="criado_por" value="1">
            <input type="hidden" name="tipo" value="Endereco">
        </div>
        <div class="form-group col-md-3">
            <label for="meio_nome"><b>Nome do Meio</b></label>
            <input type="text" class="form-control" name="meio_nome" id="meio_nome" autocomplete="off" value="<?php if (isset($DataFunc['meio_nome'])) echo $DataFunc['meio_nome']; ?>">
        </div>
        <div class="form-group col-md-3">
            <label for="ult_nome"><b>Sobrenome</b></label>
            <input type="text" class="form-control" name="ult_nome" id="ult_nome" autocomplete="off" value="<?php if (isset($DataFunc['ult_nome'])) echo $DataFunc['ult_nome']; ?>">
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
            <input type="text" class="form-control" name="salario_inicial" id="salario_inicial" autocomplete="off" value="<?php if (isset($DataFunc['salario_inicial'])) echo $DataFunc['salario_inicial']; ?>" maxlength="11">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-3">
            <!--<a class="btn btn-success" name="dataFunc" href="main.php?url=system/rh/funcionarios/create.php&acao=dataFunc">Salvar</a>-->

            <input type="submit" class="btn btn-success" value="Gravar" name="dataFunc" />


        </div>
    </div>
</form>
