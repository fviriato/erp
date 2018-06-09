<?php

/**
 * Endereco.class.php [TIPO]
 * Descricao
 * @copyright (c) year, Fernando Viriato
 */
class Endereco {

    private $Cep;
    private $Rua;
    private $Numero;
    private $Complemento;
    private $Bairro;
    private $Cidade;
    private $Estado;
    private $Result;
    private $Error;

    public function ExeCreate(array $DataEndereco) {

        $this->Cep = $DataEndereco['cep'];
        $this->Rua = ucfirst(strtolower(strip_tags($DataEndereco['rua'])));
        $this->Numero = $DataEndereco['numero'];
        $this->Complemento = $DataEndereco['complemento'];
        $this->Bairro = ucfirst(strtolower(strip_tags($DataEndereco['bairro'])));
        $this->Cidade = ucfirst(strtolower(strip_tags($DataEndereco['cidade'])));
        $this->Estado = $DataEndereco['estado'];
        $this->checkData();
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

        if (!$this->Cep):
            $this->Error = ['O CEP é obrigatório!', WS_ALERT];
            $this->Result = false;        
        elseif (!$this->Rua):
            $this->Error = ["O nome da rua é obrigatório!", WS_ALERT];
            $this->Result = false;
        elseif (!$this->Numero):
            $this->Error = ["O número é obrigatório!", WS_ALERT];
            $this->Result = false;
        elseif (!$this->Bairro):
            $this->Error = ["O bairro é obrigatório!", WS_ALERT];
            $this->Result = false;
        elseif (!$this->Cidade):
            $this->Error = ["O nome da cidade é obrigatório!", WS_ALERT];
            $this->Result = false;
        elseif (!$this->Estado):
            $this->Error = ["O estado é obrigatório!", WS_ALERT];
            $this->Result = false;
        else:
//            $this->getFuncionario();
        endif;
    }

}
