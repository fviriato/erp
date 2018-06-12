<!--FORMULÁRIO DOS CONTATOS DE FUNCIONÁRIOS-->
<form class="Contatos" name="Contatos" method="post" action="">
    <br>
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
        <input type="hidden" name="tipo" value="Contatos">
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
            <input type="submit" class="btn btn-success" value="Gravar" name="Contatos" />
        </div>
    </div>
</form>