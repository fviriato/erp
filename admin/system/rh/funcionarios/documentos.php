<!--FORMULÁRIO DOS DOCUMENTOS DE FUNCIONÁRIOS-->
<form class="Documentos" name="Documentos" method="post" action="">
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
        <div class="form-group col-md-3">
            <input type="hidden" name="tipo" value="Documentos">
            <label for="tipo"><b>Documento</b></label>
            <select name="tipo" id="tipo" class="form-control" autocomplete="off">
                <option selected></option>
                <option value="rg">RG</option>
                <option value="cpf">CPF</option>
                <option value="habilitacao">Habilitação</option>
                <option value="ctps">Carteira Profisional</option>
            </select>
        </div>

        <div class="form-group col-md-4">
            <label for="numero"><b>Número Documento</b></label>
            <input type="text" class="form-control" name="numero" id="numero" autocomplete="off">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-3">
            <input type="submit" class="btn btn-success" value="Gravar" name="Documentos" />
        </div>
    </div>
</form>

