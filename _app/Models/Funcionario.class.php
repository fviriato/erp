<?php

/**
 * Fornecedor.class [TIPO]
 * Descricao
 * @copyright (c) year, Fernando Viriato
 */
class Funcionario {

    private $Data;
    private $PriNome;
    private $MeioNome;
    private $Sobrenome;
    private $DataNasc;
    private $Sexo;
    private $EstCivil;
    private $DtAdmissao;
    private $Cargo;
    private $Departamento;
    private $Salario;
    private $Error;
    private $Result;

    function getError() {
        return $this->Error;
    }

    function getResult() {
        return $this->Result;
    }
    
    public function ExeCreate(array $Data) {
        $this->Data = $Data;
        $this->PriNome = (string) ucfirst(strtolower(strip_tags($Data['pri_nome'])));
        $this->MeioNome = (string) ucfirst(strtolower(strip_tags($Data['meio_nome'])));
        $this->Sobrenome = (string) ucfirst(strtolower(strip_tags($Data['ult_nome'])));
        $this->DataNasc = $Data['dt_nascimento'];
        $this->Sexo = (int) $Data['sexo_id'];
        $this->EstCivil = (int) $Data['estado_civil_id'];
        $this->DtAdmissao = $Data['dt_admissao'];
        $this->Cargo = (int) $Data['cargo_id'];
        $this->Departamento = (int) $Data['departamento_id'];
        $this->Salario = (float) $Data['salario_inicial'];
        $this->setFuncionario();

        //*************MÉTODOS PRIVADOS*************//
    }

    private function setFuncionario() {

        if (!$this->PriNome || !$this->Sobrenome):
            $this->Error = ['O Nome e o Sobrenome são Obrigatórios!', WS_ALERT];
            $this->Result = false;
        elseif (!$this->DataNasc):
            $this->Error = ["Informar a data de nascimento do funcionário(a) {$this->PriNome} {$this->MeioNome} {$this->Sobrenome}!", WS_ALERT];
            $this->Result = false;
        elseif (!$this->Sexo):
            $this->Error = ["Informar sexo do funcionário(a) {$this->PriNome} {$this->MeioNome} {$this->Sobrenome}!", WS_ALERT];
            $this->Result = false;
        elseif (!$this->EstCivil):
            $this->Error = ["Informar o estado civil do funcionário(a) {$this->PriNome} {$this->MeioNome} {$this->Sobrenome}!", WS_ALERT];
            $this->Result = false;
        elseif (!$this->DtAdmissao):
            $this->Error = ["Informar a data de admissão do funcionário(a) {$this->PriNome} {$this->MeioNome} {$this->Sobrenome}!", WS_ALERT];
            $this->Result = false;
        elseif ($this->DtAdmissao > date('Y-m-d')):
            $this->Error = ["A data de admissão informada é superior à data de hoje!", WS_ALERT];
            $this->Result = false;
        elseif (!$this->Cargo):
            $this->Error = ["Informar o cargo do funcionário(a) {$this->PriNome} {$this->MeioNome} {$this->Sobrenome}!", WS_ALERT];
            $this->Result = false;
        elseif (!$this->Departamento):
            $this->Error = ["Informar o departamento do funcionário(a) {$this->PriNome} {$this->MeioNome} {$this->Sobrenome}!", WS_ALERT];
            $this->Result = false;
        elseif (!$this->Salario):
            $this->Error = ["Informar o salário inicial do funcionário(a) {$this->PriNome} {$this->MeioNome} {$this->Sobrenome}!", WS_ALERT];
            $this->Result = false;
        else:
            $this->getFuncionario();
        endif;
    }

    private function getFuncionario() {

        $ReadFunc = new Read;
        $ReadFunc->ExeRead('funcionario', "WHERE pri_nome=:p AND meio_nome=:m AND ult_nome=:u AND dt_nascimento=:n", "p={$this->PriNome}&m={$this->MeioNome}&u={$this->Sobrenome}&n={$this->DataNasc}");

        if ($ReadFunc->getResult()):

            $DtNasc = date('d/m/Y', strtotime(str_replace('-', '/', $this->DataNasc)));
            $this->Error = ["O Funcionário(a) <b>{$this->PriNome} {$this->MeioNome} {$this->Sobrenome}</b> nascido(a) em <b>{$DtNasc}</b> já está cadastrado(a) no sistema!", WS_ERROR];
            $this->Result = false;
        else:
            $Create = new Create;
            $Create->ExeCreate('funcionario', $this->Data);

            if ($Create->getResult()):
                $this->Error = ["Funcionário <b>{$this->PriNome} {$this->MeioNome} {$this->Sobrenome}</b> cadastrado com sucesso!", WS_ACCEPT];
                $this->Result = true;
            else:
                $this->Error = ["Erro: Não foi possível efetuar o cadastro no sistema!", WS_ERROR];
                $this->Result = false;
            endif;

        endif;
    }

}
