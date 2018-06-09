<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>

        <?php
        $mes = filter_input(INPUT_POST, 'mes', FILTER_DEFAULT);
        $ano = filter_input(INPUT_POST, 'ano', FILTER_DEFAULT);
        $dias = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);

        var_dump($dias, $mes, $ano);
        ?>
        <form method="POST">
            <div>
                <label>Mês</label>
                <select name="mes">
                    <option></option>
                    <option value="01">Janeiro</option>
                    <option value="02">Fevereiro</option>
                    <option value="03">Março</option>
                    <option value="04">Abril</option>
                    <option value="05">Maio</option>
                    <option value="06">Junho</option>
                    <option value="07">Julho</option>
                    <option value="08">Agosto</option>
                    <option value="09">Setembro</option>
                    <option value="10">Outubro</option>
                    <option value="11">Novembro</option>
                    <option value="12">Dezembro</option>
                </select>
                <label>Ano</label>
                <select name="ano">
                    <option></option>
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                </select>               
                <button >Gerar Planilha</button>
            </div>
        </form>

        
        <table style="border: 1px solid red;">
            <thead style="border: 1px solid blue;">
                <tr>
                    <td>Casa</td>
                </tr>
                <tr>
                    <td>Teste</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Valor</td>
                    <td>Informação</td>
                </tr>
                <tr>
                    <td>88</td>
                </tr>
            </tbody>
        </table>
        <?php
        $qtd_dias = 1;

        while ($qtd_dias <= $dias):
            echo "<table>";
            echo '<tr>';
            echo '<td>';
            echo '</td>';
            echo '</tr>';
            echo "</table>";

            $qtd_dias++;
        endwhile;
        ?>



    </body>
</html>
