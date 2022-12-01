<?php

use Cassandra\Date;

class Vehicule
{
    private string $NoImmatriculation;
    private string $CodeClient;
    private string $NumModele;
    private string $NoSerie;
    private DateTime $DateMiseEnCirculation;

    /**
     * @param string $NoImmatriculation
     * @param string $CodeClient
     * @param string $NumModele
     * @param string $NoSerie
     * @param DateTime $DateMiseEnCirculation
     */
    public function __construct(string $NoImmatriculation, string $CodeClient, string $NumModele, string $NoSerie, DateTime $DateMiseEnCirculation)
    {
        $this->NoImmatriculation = $NoImmatriculation;
        $this->CodeClient = $CodeClient;
        $this->NumModele = $NumModele;
        $this->NoSerie = $NoSerie;
        $this->DateMiseEnCirculation = $DateMiseEnCirculation;
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
    public function getNumModele(): string
    {
        return $this->NumModele;
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
     * @return DateTime
     */
    public function getDateMiseEnCirculation(): DateTime
    {
        return $this->DateMiseEnCirculation;
    }

    /**
     * @param DateTime $DateMiseEnCirculation
     */
    public function setDateMiseEnCirculation(DateTime $DateMiseEnCirculation): void
    {
        $this->DateMiseEnCirculation = $DateMiseEnCirculation;
    }

}