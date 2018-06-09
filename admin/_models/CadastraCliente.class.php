<?php

/**
 * CadastraCliente.class.php [TIPO]
 * Descricao
 * @copyright (c) year, Fernando Viriato
 */
class CadastraCliente {

    private $Cliente;
//    private $cnpj;
//    private $RazaoSocial;
//    private $NomeFantasia;
//    private $InscricaoEstadual;
//    private $InscricaoMunicipal;
//    private $DiaEntrega;
//    private $Status;
//    private $EmitirNf;
    private $Result;
    private $Error;

    public function ExeCadastro(array $DataCliente) {

        $this->Cliente = $DataCliente;
        $this->checkData();


//        $this->cnpj = $DataCliente['cnpj_cpf'];
//        $this->RazaoSocial = $DataCliente['razao_social'];
//        $this->NomeFantasia = $DataCliente['nome_fantasia'];
//        $this->InscricaoEstadual = $DataCliente['insc_estadual'];
//        $this->InscricaoMunicipal = $DataCliente['insc_municipal'];
//        $this->Status = $DataCliente['status'];
//        $this->EmitirNf = $DataCliente['emitir_nota'];
//        $this->DiaEntrega = $DataCliente['dia_entrega'];
    }

    function getError() {
        return $this->Error;
    }

    function getResult() {
        return $this->Result;
    }

    /*
     * ***************************************
     * **********  PRIVATE METHODS  **********
     * ***************************************
     */

    private function checkData() {
        if (in_array('', $this->Cliente)):
            $this->Error = ["Existem campos em branco. Favor preencha todos os campos!", WS_ALERT];
            $this->Result = false;
        else:
            $this->validaCnpj();
        endif;
    }

    private function validaCnpj() {

        $this->setCnpj();

        if (strlen($this->Cliente['cnpj_cpf']) != 14):
            $this->Error = ["O CNPJ <b>{$this->Cliente['cnpj_cpf']}</b> está incorreto!", WS_ERROR];
            $this->Result = false;
        else:


        endif;
    }

    private function setCnpj() {

        $this->Cliente['cnpj_cpf'] = preg_replace('/[^0-9]/', '', (string) $this->Cliente['cnpj_cpf']);
        $this->Result = $this->Cliente['cnpj_cpf'];
        $this->getCnpj();
    }

    private function getCnpj() {


        $ReadCnpj = new Read;
        $ReadCnpj->ExeRead("cliente", "WHERE cnpj_cpf=:c", "c={$this->Cliente['cnpj_cpf']}");

        if ($ReadCnpj->getResult()):
            $this->Error = ["O Cnpj {$this->Cliente['cnpj_cpf']} já está cadastrado no Sistema", WS_ERROR];
            $this->Result = FALSE;
        else:
            $Create = new Create;
            $Create->ExeCreate("cliente", $this->Cliente);
            $this->Error = ["O Cliente <b>{$this->Cliente['razao_social']}</b>  foi cadastrado com Sucesso!", WS_ACCEPT];
            $this->Result = TRUE;
        endif;
    }

}
