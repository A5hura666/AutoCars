<?php
// Classe de connexion à une base de données
// S'inspire du pattern singleton pour n'ouvrir qu'une seule connexion
// Utilisation :
//    $bd = MaBD::getInstance(); // $bd est un objet PDO
class MaBD {

   static private $pdo = null; // Le singleton

   // Obenir le singleton
   static function getInstance(): PDO {
      if (self::$pdo == null) {
         $dsn = "mysql:host=gigondas;dbname=graillet;charset=utf8";
         self::$pdo = new PDO($dsn, "graillet", "graillet");
      }
      return self::$pdo;
   }

   static function getSchema(){
       self::getInstance();
       return self::$pdo->getSchema("SAE_role");
   }
}
