<?php
$q = '';
if (isset($_POST['q'])):
    $q = trim($_POST['q']);
endif;
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
    <body>
        <div class="panel panel-default">
            <!--Default panel contents-->   
                <div class="panel-heading">
                    <h1 class="panel-title text-primary">Módulos do Sistema</h1>
                </div>
            <div class="panel-title right" ><a href="main.php?url=system/modulo/create.php"><h5><span class="label label-success">Inserir Módulo</span></h5></a></div>


            <div class="navbar-form">
                <div class="trigger-box"></div>
                <form class="j_search" style="margin-left: 150px; padding: 7px" class="navbar-form navbar-left" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" name="q" placeholder="Informações do Módulo" value="<?php echo $q; ?>">
                    </div>
                    <input class="btn" type="submit" value="Pesquisar">
                </form>
            </div>

            <div class="table-bordered">
                <!-- Table -->
                <table class="table">
                    <tr>
                    <thead class="text-primary">
                    <th>Código</th>
                    <th>Módulo</th>
                    <th>Informações</th>
                    <th>Página</th>
                    <th>Ação</th>
                    </thead>
                    </tr>
                    <?php
                    $sql = "select * from modulo";

                    $array = array();
                    if ($q != '') {
                        $array[] = " (id like '%$q%')";
                    }

                    if ($q != '') {
                        $array[] = " (cnpj_cpf like '%$q%')";
                    }

                    if ($q != '') {
                        $array[] = " (razao_social like '%$q%')";
                    }
                    if ($q != '') {
                        $array[] = " (nome_fantasia like '%$q%')";
                    }
                    if ($q != '') {
                        $array[] = " (nome_fantasia like '%$q%')";
                    }

                    if ($array):
                        $sql .=" WHERE " . join(' or ', $array) . "order by id";
                    else:
                        $sql = $sql . " order by id";

                    endif;
                    $read = new Read;
                    $read->FullRead($sql);

//                    $read->ExeRead("cliente");
                    if ($read->getResult()):
                        foreach ($read->getResult() as $modulo):
                            ?>
                            <tbody>
                            <td><?php echo $modulo['id']; ?></td>
                            <td><?php echo $modulo['nome']; ?></td>
                            <td><?php echo $modulo['informacoes']; ?></td>
                            <td><?php echo $modulo['pagina']; ?></td>
                            <td>
                                <a class="text-danger" href="main.php?url=system/modulo/update.php&id=<?php echo $modulo['id']; ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true" title="Editar"></span></a>  
                                <a href=""><span class="glyphicon glyphicon-list-alt" aria-hidden="true" title="Pedido"></span></a>  
                            </td>
                            </tbody>
                        <?php endforeach; ?>
                    </table>
                <?php endif; ?>     








            </div>
        </div>
<!--        <script src="js/jquery.js"></script>
        <script src="js/cliente.js"></script>-->
    </body>
</html>
