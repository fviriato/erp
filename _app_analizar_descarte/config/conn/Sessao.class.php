<?php

  /**
   * Sessions.class [ TIPO ]
   * Descricao Classe Responsável por criar sessão de usuário
   * @copyright (c) year, Fernando Viriato
   */
  class Sessao {

      public $usuario;
      public $maquina;
      public $data;

      function __construct() {
          $this->CheckSession();
          $this->usuario = (string) strip_tags($UserData['usuario']);
      }

      public function CheckSession() {
          if (!$_SESSION['usuario']):
              session_start();
          endif;
          
      }
  }
  