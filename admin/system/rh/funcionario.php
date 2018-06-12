<?php
$q = '';
if (isset($_POST['q'])):
    $q = trim($_POST['q']);
endif;
?>


<!DOCTYPE html>

<html lang="pt-br">
    <!--    <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="css/admin.css" type="text/css">
            <link rel="stylesheet" href="css/reset.css" type="text/css">
            <title></title>
        </head>-->
    <body>


        <div class="panel panel-primary">
            <!--Default panel contents-->   

            <div class="panel-heading">
                <h3 class="panel-title">Menu</h3>
            </div>

            <div class="container-fluid">
                <br>
                <h3 class="text-primary">Cadastro de Funcionários</h3><hr>

                <a href="main.php?url=system/rh/funcionarios/create.php"><div class="btn-primary size">
                        Cadastrar Funcionário
                    </div></a>
                <div class="btn-primary size">
                    Editar Funcionário
                </div>
                <div class="btn-primary size">
                    Pesquisar Funcionário
                </div>
                <div class="btn-primary size">
                    Estatísticas Funcionário
                </div>
            </div>
            <div class="container-fluid">
                <br>
                <h3 class="text-primary">Benefícios</h3><hr>

                <div class="btn-primary size">
                    Criar Benefício
                </div>
                <div class="btn-primary size">
                    Editar Benefício
                </div>
                <div class="btn-primary size">
                    Atribuir Benefício
                </div>             
            </div>
            <div class="container-fluid">
                <br>
                <h3 class="text-primary">Cargos & Departamentos</h3><hr>

                <div class="btn-primary size">
                    Criar <br>Cargo
                </div>
                <div class="btn-primary size text-center">
                    Editar <br> Cargo
                </div>
                <div class="btn-primary size">
                    Pesquisar Cargo
                </div>
                <div class="size" style="background-color: white; height: 62px; width: 10px; margin-right: 20px; border-right: 1px solid #ccc">
                </div>
                <div class="btn-primary size">
                    Criar Departamento
                </div>
                <div class="btn-primary size">
                    Editar Departamento
                </div>
                <div class="btn-primary size">
                    Pesquisar Departamento
                </div>
            </div>
            <hr>
        </div>
        <script src="js/jquery.js"></script>
        <script src="js/funcoes.js"></script>
    </body>
</html>
