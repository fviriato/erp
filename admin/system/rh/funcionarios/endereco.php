<!--FORMULÁRIO DE ENDEREÇO DE FUNCIONÁRIOS-->
<form name="DataEndereco" method="POST" action="">
    <br>
    <div>
        <?php
        $Endereco = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if ($Endereco['DataEndereco']):
            unset($Endereco['DataEndereco']);

            $CreateEndereco = new Endereco;
            $CreateEndereco->ExeCreate($Endereco);

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
        <div class="form-group col-md-2">
            <label for="cep"><b>Cep</b></label>
            <input type="text" class="form-control" name="cep" id="cep" autocomplete="off" onblur="endereco" maxlength="8">
            <input type="hidden" name="tipo" value="Endereco">
        </div>

        <div class="form-group col-md-5">
            <label for="rua"><b>Rua</b></label>
            <input type="text" class="form-control" name="rua" id="rua" autocomplete="off">
        </div>

        <div class="form-group col-md-2">
            <label for="numero"><b>Número</b></label>
            <input type="text" class="form-control" name="numero" id="numero" autocomplete="off">
        </div>
        <div class="form-group col-md-3">
            <label for="complemento"><b>Complemento</b></label>
            <input type="text" class="form-control" name="complemento" id="complemento" autocomplete="off">
        </div>
    </div>
    <div class="row">

        <div class="form-group col-md-4">
            <label for="bairro"><b>Bairro</b></label>
            <input type="text" class="form-control" name="bairro" id="bairro" autocomplete="off">
        </div>                   

        <div class="form-group col-md-4">
            <label for="cidade"><b>Cidade</b></label>
            <input type="text" class="form-control" name="cidade" id="cidade" autocomplete="off">
        </div>

        <div class="form-group col-md-2">
            <label for="uf"><b>Estado</b></label>
            <input type="text" class="form-control" name="uf" id="uf" autocomplete="off" maxlength="2">
        </div>


    </div>
    <div class="row">
        <div class="form-group col-md-3">
            <input type="submit" class="btn btn-success j_Endereco" value="Gravar" name="DataEndereco" />
        </div>
    </div>
</form>