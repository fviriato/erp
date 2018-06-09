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
                    <h3 class="panel-title">Clientes</h3>
                </div>
            <div class="panel-title right" ><a href="main.php?url=system/cliente/create.php"><h5><span class="label label-success">Novo Cliente</span></h5></a></div>





            <div class="form-group">
                <form style="margin-left: 150px; padding: 7px" class="navbar-form navbar-left" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" name="q" placeholder="Informações do Cliente" value="<?php echo $q; ?>">
                    </div>
                    <input class="btn btn-primary" type="submit" value="Pesquisar">
                </form>
            </div>


            <div class="panel-body">
                <!-- Table -->
                <table class="table">
                    <tr>
                    <thead class="text-primary">
                    <th>Código</th>
                    <th>Razão Social</th>
                    <th>Cnpj | Cpf</th>
                    <th>Status</th>
                    <th>Dia da Entrega</th>
                    <th>Vendedor</th>
                    <th>Ação</th>
                    </thead>
                    </tr>
                    <?php
                    $sql = "select * from cliente";

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
                        foreach ($read->getResult() as $cliente):
                            ?>
                            <tbody>
                            <td><?php echo $cliente['id']; ?></td>
                            <td><?php echo $cliente['razao_social']; ?></td>
                            <td><?php echo $cliente['cnpj_cpf']; ?></td>
                            <td><?php echo $cliente['status']; ?></td>
                            <td><?php echo $cliente['dia_entrega']; ?></td>
                            <td><?php echo $cliente['classe_funcionario_id']; ?></td>
                            <td>
                                <a class="text-danger" href="main.php?url=system/cliente/update.php&id=<?php echo $cliente['id']; ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true" title="Editar"></span></a>  
                                <a href=""><span class="glyphicon glyphicon-list-alt" aria-hidden="true" title="Pedido"></span></a>  
                            </td>
                            </tbody>
                            <?php
                        endforeach;
                    endif;
                    ?>
                </table>









            </div>
        </div>
<!--        <script src="js/jquery.js"></script>
        <script src="js/cliente.js"></script>-->
    </body>
</html>
