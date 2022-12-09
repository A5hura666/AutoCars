<?php

class Modele
{
    private int $NumModele;
    private string $NumMarque;
    private string $Modèle;

    /**
     * @param int $NumModele
     * @param string $NumMarque
     * @param string $Modèle
     */
    public function __construct(int $NumModele, string $NumMarque, string $Modèle)
    {
        $this->NumModele = $NumModele;
        $this->NumMarque = $NumMarque;
        $this->Modèle = $Modèle;
    }

    /**
     * @return int
     */
    public function getNumModele(): int
    {
        return $this->NumModele;
    }

    /**
     * @param int $NumModele
     */
    public function setNumModele(int $NumModele): void
    {
        $this->NumModele = $NumModele;
    }

    /**
     * @return string
     */
    public function getNumMarque(): string
    {
        return $this->NumMarque;
    }

    /**
     * @param string $NumMarque
     */
    public function setNumMarque(string $NumMarque): void
    {
        $this->NumMarque = $NumMarque;
    }

    /**
     * @return string
     */
    public function getModèle(): string
    {
        return $this->Modèle;
    }

    /**
     * @param string $Modèle
     */
    public function setModèle(string $Modèle): void
    {
        $this->Modèle = $Modèle;
    }

}