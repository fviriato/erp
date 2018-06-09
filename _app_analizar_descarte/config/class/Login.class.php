<?php

/**
 * Login.class [TIPO]
 * CLASSE RESPONSÁVEL POR EFETUAR O LOGIN NO SISTEMA, GERENCIANDO OS DEVIDOS NÍVEIS DE ACESSO
 * @copyright (c) year, Fernando Viriato
 */
class Login {

    private $Usuario;
    private $Senha;
    private $Result;
    private $Error;

    public function ExeLogin(array $UserData) {
        $this->Usuario = (string) strip_tags($UserData['usuario']);
        $this->Senha = (string) strip_tags($UserData['senha']);
        $this->SetLogin();
    }

    function getResult() {
        return $this->Result;
    }

    function getError() {
        return $this->Error;
    }

    public function checkLogin() {
        if (!$_SESSION['usuario']):
            unset($_SESSION['usuario']);
            return false;
        else:
            return true;
        endif;
    }

    private function SetLogin() {
        If (!$this->Usuario || !$this->Senha):
            $this->Error = ['Informe seu Usuário e a sua Senha!', WS_ALERT];
            return false;
        elseif (!$this->getUser()):
            $this->Error = ['Os dados informados não são compatíveis!', WS_ERROR];
            return false;
        else:
            $this->Execute();
        endif;
    }

    private function getUser() {
        //CRIPTOGRAFAR SENHA
//          $this->Senha = md5($this->Senha);
        $read = new Read;
        $read->ExeRead("usuario", "WHERE USU_LOGIN = :u AND USU_SENHA =:s", "u={$this->Usuario}&s={$this->Senha}");
        if ($read->getResult()):
            $this->Result = $read->getResult()[0];
            return true;
        else:
            return false;
        endif;
    }

    private function Execute() {
        if (!session_id()):
            session_start();
        endif;
        $_SESSION['usuario'] = $this->Result;
        $this->Result = true;
    }

}
