<?php

class Vehicule
{
    private string $NoImmatriculation;
    private string $CodeClient;
    private string $Modele;
    private string $NoSerie;
    private string $DateMiseEnCirculation;
    private string $Marque;

    /**
     * @param string $NoImmatriculation
     * @param string $CodeClient
     * @param string $NumModele
     * @param string $NoSerie
     * @param string $DateMiseEnCirculation
     * @param string $Marque
     */
    public function __construct(string $NoImmatriculation, string $CodeClient, string $Modele, string $NoSerie, string $DateMiseEnCirculation, string $Marque)
    {
        $this->NoImmatriculation = $NoImmatriculation;
        $this->CodeClient = $CodeClient;
        $this->Modele = $Modele;
        $this->NoSerie = $NoSerie;
        $this->DateMiseEnCirculation = $DateMiseEnCirculation;
        $this->Marque = $Marque;
    }

    /**
     * @return string
     */
    public function getNoImmatriculation(): string
    {
        return $this->NoImmatriculation;
    }

    /**
     * @param string $NoImmatriculation
     */
    public function setNoImmatriculation(string $NoImmatriculation): void
    {
        $this->NoImmatriculation = $NoImmatriculation;
    }

    /**
     * @return string
     */
    public function getCodeClient(): string
    {
        return $this->CodeClient;
    }

    /**
     * @param string $CodeClient
     */
    public function setCodeClient(string $CodeClient): void
    {
        $this->CodeClient = $CodeClient;
    }

    /**
     * @return string
     */
    public function getModele(): string
    {
        return $this->Modele;
    }

    /**
     * @param string $NumModele
     */
    public function setNumModele(string $NumModele): void
    {
        $this->NumModele = $NumModele;
    }

    /**
     * @return string
     */
    public function getNoSerie(): string
    {
        return $this->NoSerie;
    }

    /**
     * @param string $NoSerie
     */
    public function setNoSerie(string $NoSerie): void
    {
        $this->NoSerie = $NoSerie;
    }

    /**
     * @return string
     */
    public function getDateMiseEnCirculation(): string
    {
        return $this->DateMiseEnCirculation;
    }

    /**
     * @param string $DateMiseEnCirculation
     */
    public function setDateMiseEnCirculation(string $DateMiseEnCirculation): void
    {
        $this->DateMiseEnCirculation = $DateMiseEnCirculation;
    }

    /**
     * @return string $marque
     */

    public function getMarque():string{
        return $this->Marque;
    }


}