<!DOCTYPE html>

<article>
    <div class="container">

        <div class="page-header">
            <h1><i class="fa fa-book"></i>  Aulas Agendadas</h1>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <h3 class="panel-title pull-left"><b>Informações do Agendamento de Aula</b></h3> <a class="small pull-right btn-warning" href="aula-agendar.php"> Agendar Aula</a>


            </div>
            <div class="panel-body">
                <form class="form-inline" role="form" method="get" action="">
                    <div class="form-group">
                        <label class="sr-only" for="fq">Pesquisa</label>

                        <input type="search" class="form-control" id="fq" name="q" placeholder="Pesquisa" value="<?php echo $q; ?>">
                    </div>
                    <button type="submit" class="btn btn-default">Pesquisar</button>
                </form>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Dia da Semana</th>
                        <th>Aluno</th>
                        <th>Matéria</th>
                        <th>Professor</th>
                        <th>Local</th>
                        <th>Tmp. Aula</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM aula a
                                                inner join aluno l
                                                        on (a.ALUNO_alu_id = l.alu_id) 
                                                inner join materia m
                                                        on (a.MATERIA_mat_id = m.mat_id)
                                                inner join professor p
                                                        on (a.PROFESSOR_pro_id = p.pro_id)
                                                inner join local lo
                                                        on (a.LOCAL_LOC_ID = lo.LOC_ID)";
                    $array = array();

                    if ($q != '') {
                        $array[] = "(l.alu_nome like '%$q%')";
                    }
                    if ($q != '') {
                        $array[] = " (m.mat_descricao like '%$q%')";
                    }
                    if ($q != '') {
                        $array[] = " (p.pro_nome like '%$q%')";
                    }
                    if ($q != '') {
                        $array[] = " (lo.LOC_DESCRICAO like '%$q%')";
                    }
                    if ($array) {
                        $sql .= " Where " . join(' or ', $array) . " ORDER BY a.aul_dt ASC";
                    } else {
                        $sql = $sql . " ORDER BY a.aul_dt DESC";
                    }

                    setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
                    date_default_timezone_set('America/Sao_Paulo');

                    $consulta = mysqli_query($con, $sql);

                    while ($resultado = mysqli_fetch_assoc($consulta)) {
                        $data_aula = date(("d/m/Y"), strtotime($resultado['aul_dt']));
                        $data_extenso = strtoupper(strftime('%A', strtotime($resultado['aul_dt'])));

                        $Hinicio = strtotime($resultado['aul_hora_inicio']);
                        $Hfim = strtotime($resultado['aul_hora_fim']);
                        $TmpAula = ($Hfim - $Hinicio) / 3600;
                        ?>
                        <tr>
                            <td><?php echo $data_aula; ?></td>
                            <td><?php echo $data_extenso; ?></td>
                            <td><?php echo $resultado['alu_nome']; ?></td>
                            <td><?php echo $resultado['mat_descricao']; ?></td>
                            <td><?php echo $resultado['pro_nome']; ?></td>
                            <td><?php echo $resultado['LOC_DESCRICAO']; ?></td>
                            <td><?php echo $TmpAula . " hora(s)"; ?></td>
                            <td>
                                <a href="aula-editar.php?aul_id=<?php echo $resultado['aul_id']; ?>" title="Editar Aula"><i class="fa fa-edit fa-lg"></i></a>
                                <a href="aula-apagar.php?aul_id=<?php echo $resultado['aul_id']; ?>" title="Cancelar Escola"><i class="fa fa-times fa-lg"></i></a>
                            </td>
                        </tr><?php
                }
                    ?>
                </tbody>
            </table>
        </div>







        <!--<div class="form_create">-->
        <div class="panel-heading">
            <h3 class="panel-title">Cadastrar Módulos no Sistema</h3>
        </div>

        <form class="j_juridica" name="DataCliente" method="post" action="">
            <div>
                <?php
                $Data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                if ($Data['dataModulo']):
                    unset($Data['dataModulo']);

                    $Create = new CadastraModulo;
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

            <!--Cadastro de Módulos do Sistema-->

            <div class="row">
                <div class="form-group col-md-3">
                    <label for="modulo"><b>Módulo</b></label>
                    <input type="text" class="form-control" name="modulo" id="modulo" placeholder="Nome do Módulo" autocomplete="off" value="<?php if (isset($Data['modulo'])) echo $Data['modulo']; ?>">
                    <input type="hidden" name="dt_cadastro" value="<?php echo date('Y-m-d'); ?>">
                    <input type="hidden" name="exibir" value="sim">
                </div>
                <div class="form-group col-md-6">
                    <label for="informacoes"><b>Informações Sobre o Módulo</b></label>
                    <input type="text" class="form-control" name="informacoes" id="informacoes" placeholder="Informações Adicionais Sobre o Módulo" autocomplete="off" value="<?php if (isset($Data['informacoes'])) echo $Data['informacoes']; ?>">
                </div>
            </div>



            <div class="row">
                <div class="form-group col-md-3">
                    <label for="pagina"><b>Nome da Página</b></label>
                    <input type="text" class="form-control" name="pagina" id="pagina" placeholder="Nome da Página" autocomplete="off" value="<?php if (isset($Data['pagina'])) echo $Data['pagina']; ?>">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-3">

                    <a class="btn btn-primary" href="main.php?url=system/modulos/create.php&acao=dataModulo">Cadastrar</a>

                                        <!--<input type="submit" class="btn btn-primary" value="Cadastrar" name="SendDataCliente" />-->
                </div>
            </div>

            <br>
        </form>



        <!--<div class="clear"></div>-->
    </div> <!-- content home -->
    <!--</div>-->

</article>