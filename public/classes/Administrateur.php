<?php
// Représentation d'un administrateur
class Administrateur {
     public $id;
     public $login;
     public $mdp;

     public function __construct(int $id, string $l, string $m) {
         $this->id = $id; $this->login = $l; $this->mdp = $m;
     }

     public function __tostring() {
         return "$this->id : $this->login $this->mdp";
     }
}
