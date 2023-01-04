<?php

class Vehicule
{
    private string $NoImmatriculation;
    private int $CodeClient;
    private int $NumModele;
    private string $NoSerie;
    private string $DateMiseEnCirculation;
    private string $marque;

    /**
     * @param string $NoImmatriculation
     * @param int $CodeClient
     * @param int $NumModele
     * @param string $NoSerie
     * @param string $DateMiseEnCirculation
     * @param string $marque
     */
    public function __construct(string $NoImmatriculation, int $CodeClient, int $NumModele, string $NoSerie, string $DateMiseEnCirculation, string $marque)
    {
        $this->NoImmatriculation = $NoImmatriculation;
        $this->CodeClient = $CodeClient;
        $this->NumModele = $NumModele;
        $this->NoSerie = $NoSerie;
        $this->DateMiseEnCirculation = $DateMiseEnCirculation;
        $this->marque = $marque;
    }

    /**
     * @return string
     */
    public function getMarque(): string
    {
        return $this->marque;
    }

    /**
     * @param string $marque
     */
    public function setMarque(string $marque): void
    {
        $this->marque = $marque;
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
     * @return int
     */
    public function getCodeClient(): string
    {
        return $this->CodeClient;
    }

    /**
     * @param int $CodeClient
     */
    public function setCodeClient(int $CodeClient): void
    {
        $this->CodeClient = $CodeClient;
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
    


}