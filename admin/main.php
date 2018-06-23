<?php
session_start();

require('../_app/Config.inc.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <!--<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">-->
        <link rel="stylesheet" href="css/admin.css" type="text/css">
        <!--<link href="https://fonts.googleapis.com/css?family=Roboto:900" rel="stylesheet">-->
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>

        <header>
            <a href="../logout.php"id="logout">Logout</a>            
        </header>


        <nav>
            <div id="logo">
            </div>
            <h4>Menu</h4>
            <!--            <a href="main.php?url=system/cliente/create.php">Cadastrar Cliente</a><br>
                        <a href="main.php?url=system/cliente/update.php">Update Cliente</a>-->
            <?php
            $Menu = new Read;
            $Menu->ExeRead("menu", "WHERE exibir='sim'");
            if ($Menu->getResult()):
                echo '<ul>';
                foreach ($Menu->getResult() as $MostrarMenu):
                    echo '<li>';
                    echo '<a href="#">' . $MostrarMenu['menu'] . '</a>';
                    $SubMenu = new Read;
                    $SubMenu->ExeRead("sub_menu", "WHERE exibir='sim' AND menu_id=" . $MostrarMenu['id']);
                    if ($SubMenu->getResult()):
                        echo '<ul>';
                        foreach ($SubMenu->getResult() as $MostrarSubMenu):
                            echo '<li>';
                            echo '<a href="main.php?url=system/' . strtolower($MostrarMenu['pagina']) . '/' . $MostrarSubMenu['pagina'] . '"#">' . $MostrarSubMenu['submenu'] . '</a>';
                            echo '</li>';
                        endforeach;
                        echo '</ul>';
                    endif;

                    echo '</li>';
                endforeach;
                echo '</ul>';
            endif;
            ?>
        </nav>
        <div id="frame">            
            <div id="conteudo">            
                <?php
                $pagina = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);
                if ($pagina):
                    include_once $pagina;
                endif;
                ?>
            </div>
        </div>


        <footer>
            <h4>Rodape</h4>
        </footer>
    </body>
</html>
