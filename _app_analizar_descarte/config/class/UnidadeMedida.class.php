<?php

/**
 * UnidadeMedida.class [TIPO]
 * Classe Responsável por Cadastrar e Gerenciar Unidades de Medidas
 * @copyright (c) year, Fernando Viriato
 */
class UnidadeMedida {

    private $Nome;
    private $Sigla;
    private $Result;
    private $Error;

    public function ExeCreate(array $Data) {
        $this->Nome = (string) strip_tags($Data['nome']);
        $this->Sigla = (string) strip_tags($Data['sigla']);
        $this->setUnidade($Data);
    }

    function getResult() {
        return $this->Result;
    }

    function getError() {
        return $this->Error;
    }

    //Metodos Privados

    private function getUnidade() {
        $Read = new Read;
        $Read->ExeRead("unidade_medida", "WHERE nome = :nome AND sigla= :sigla", "nome={$this->Nome}&sigla={$this->Sigla}");
        if (!$Read->getResult):
            $this->Result = $Read->getResult()[0];
            return TRUE;
        else:
            return FALSE;
        endif;
    }

    private function setUnidade($Data) {
        if (in_array('', $Data)):
            $this->Error = ['Você Deve Preencher Todos os Campos!'];
            return false;
        elseif (!$this->getUnidade()):
            $this->Error = ["{$Data['nome']} já Está Cadastrado no Sistema!", WS_INFOR];
        else:
            $this->exeCadastra($Data);
        endif;
    }

    private function exeCadastra($Data) {
        $Create = new Create();
        $Create->ExeCreate('unidade_medida', $Data);
        $this->Error = ["{$Data['nome']} Foi Cadastrado com Sucesso!", WS_ACCEPT];
        return true;
    }

}
