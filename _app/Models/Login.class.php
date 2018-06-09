<?php

/**
 * Login.class [MODEL]
 * CLASSE RESPONSÁVEL POR EFETUAR O LOGIN NO SISTEMA, GERENCIANDO OS DEVIDOS NÍVEIS DE ACESSO
 * @copyright (c) year, Fernando Viriato
 */
class Login {

    private $Usuario;
    private $Senha;
    private $Result;
    private $Error;

    public function ExeLogin(array $UserData) {
        $this->Usuario = (string) strip_tags($UserData['login']);
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
        if (!$_SESSION['login']):
            unset($_SESSION['login']);
            return false;
        else:
            return true;
        endif;
    }

    private function SetLogin() {
        If (!$this->Usuario || !$this->Senha):
            $this->Error = ['Informe seu Login e a sua Senha!', WS_ALERT];
            $this->Result= false;
        elseif (!$this->getUser()):
            $this->Error = ['Os dados informados não são compatíveis!', WS_ERROR];
            $this->Result= false;
        else:
            $this->Execute();
        endif;
    }

    private function getUser() {
        //CRIPTOGRAFAR SENHA
//          $this->Senha = md5($this->Senha);
        $read = new Read;
        $read->ExeRead("usuario", "WHERE login = :l AND senha =:s", "l={$this->Usuario}&s={$this->Senha}");
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
        $_SESSION['login'] = $this->Result;
        $this->Result = true;
    }

}
