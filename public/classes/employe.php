<?php

class employe
{
    public $idemployé;
    public $nom;
    public $prénom;

    public function __construct(int $idemployé, string $nom, string $prénom) {
        $this->idemployé = $idemployé; $this->nom = $nom; $this->prénom = $prénom;
    }

    public function __tostring() {
        return "$this->idemployé : $this->nom $this->prénom";
    }
}