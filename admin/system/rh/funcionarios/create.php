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
        <div class="container-fluid">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h1 class="panel-title">Cadastro de Funcionário</h1>
                </div>
                <div class="panel-body">
                    <!--Panel content-->
                    <div class="form_create">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs">
                            <li class="nav-item active">
                                <a href="#dados" class="nav-link" role="tab" data-toggle="tab"><h5>Dados Pessoais</h5></a>
                            </li>
                            <li class="nav-item">
                                <a href="#endereco" class="nav-link" role="tab" data-toggle="tab"><h5>Endereço</h5></a>
                            </li>
                            <li class="nav-item">
                                <a href="#telefone" class="nav-link" role="tab" data-toggle="tab"><h5>Contatos</h5></a>
                            </li>
                            <li class="nav-item">
                                <a href="#documento" class="nav-link" role="tab" data-toggle="tab"><h5>Documentos</h5></a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="dados">
                                <?php include_once 'dadosPessoais.php'; ?>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="endereco">
                                <?php include_once 'endereco.php'; ?>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="telefone">
                                <?php include_once 'contatos.php'; ?>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="documento">
                                <?php include_once 'documentos.php'; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel-body panel-primary" role="alert">
                <!--<input type="submit" class="btn btn-success" value="Salvar" name="dataFunc" />-->
            </div>
        </div>
        <script type="text/javascript"></script>
        <script src="js/jquery.js"></script>
        <script src="bootstrap/js/bootstrap.js"></script>
        <script src="js/funcionarios.js"></script>
        <script src="js/jquery.mask.js"></script>
        <script src="js/jquery.mask.min.js"></script>
        <script src="js/funcoes.js"></script>
    </body>
</html>
