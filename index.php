<?php
require_once './_app/Config.inc.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <meta charset="UTF-8">
        <title>Login</title>
    </head>
    <body>

        <div class="jumbotron">
            <div class="container col-sm-4">
                <div class="card">
                    <div class="card-header">
                        <span class="titulo">Sistema de Gestão - Moramassa</span>
                    </div>
                    <div style="padding-top:15px" class="col-sm-12">
                        <?php
                        $Login = new Login;
                        $DataLogin = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                        if (!empty($DataLogin['login'])):
                            unset($DataLogin['datalogin']);
                            $Login->ExeLogin($DataLogin);
                            if (!$Login->getResult()):
                                WSErro($Login->getError()[0], $Login->getError()[1]);
                            else:
                                header('location:admin/main.php');
                            endif;
                        endif;
//
//                        echo '<pre>';
//                        var_dump($Login);
//                        echo '</pre>';
                        ?>
                    </div>
                    <div class="card-body">
                        <form name="login" method="post">
                            <div class="form-group">
                                <span class="field">Login</span>
                                <input class="form-control" type="text" name="login" autocomplete="off"/>
                            </div>
                            <div class="form-group">
                                <span class="field">Senha</span>
                                <input class="form-control" type="password" name="senha" autocomplete="off"/>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary"type="submit" name="datalogin" value="Entrar"/>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        </script>

    </body>
</html>
