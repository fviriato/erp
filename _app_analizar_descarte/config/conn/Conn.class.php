<?php

     /**
      * Conn.class.php [CONEXÃO]
      * Classe Abastrata de Conexão Padrão Singleton
      * Retorna um objeto PDO pelo metodo estático getConn();
      * @copyright (c) 2017, Fernando Viriato
      */
     class Conn {

         private static $Host = HOST;
         private static $User = USER;
         private static $Pass = PASS;
         private static $Dbsa = DBSA;

         /** @var PDO */
         private static $Connect = null;

         /**
          * Conecta com o banco de dados com o pattern sigleton
          * Retorna o objeto PDO
          */
         private static function Conectar() {
             try {
                 if (self::$Connect == null):
                     $dsn = 'mysql:host=' . self::$Host . ';dbname=' . self::$Dbsa;
                     $options = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'];
                     self::$Connect = new PDO($dsn, self::$User, self::$Pass, $options);
                 endif;
             } catch (PDOException $e) {
                 PHPErro($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
                 die;
             }
             self::$Connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             return self::$Connect;
         }

         /**
          * Retorna um objeto sigleton pattern
          */
         public static function getConn() {
             return self::Conectar();
         }

     }
     