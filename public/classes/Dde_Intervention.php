<?php

class Dde_Intervention
{
    private int $NumDde;
    private string $NoImmatriculation;
    private int $IdOpérateur;
    private int $CodeClient;
    private string $DateRdv;
    private string $HeureRdv;
    private string $Descriptif_demande;
    private float $km_actuel;
    private string $EtatDemande;

    /**
     * @param int $NumDde
     * @param string $NoImmatriculation
     * @param int $idOpérateur
     * @param int $CodeClient
     * @param string $DateRdv
     * @param string $HeureRdv
     * @param string $Descriptif_demande
     * @param float $km_actuel
     * @param string $EtatDemande
     */
    public function __construct(int $NumDde, string $NoImmatriculation, int $idOpérateur, int $CodeClient, string $DateRdv, string $HeureRdv, string $Descriptif_demande, float $km_actuel, string $EtatDemande)
    {
        $this->NumDde = $NumDde;
        $this->NoImmatriculation = $NoImmatriculation;
        $this->IdOpérateur = $idOpérateur;
        $this->CodeClient = $CodeClient;
        $this->DateRdv = $DateRdv;
        $this->HeureRdv = $HeureRdv;
        $this->Descriptif_demande = $Descriptif_demande;
        $this->km_actuel = $km_actuel;
        $this->EtatDemande = $EtatDemande;
    }

    /**
     * @return int
     */
    public function getNumDde(): int
    {
        return $this->NumDde;
    }

    /**
     * @param int $NumDde
     */
    public function setNumDde(int $NumDde): void
    {
        $this->NumDde = $NumDde;
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
    public function getIdOpérateur(): int
    {
        return $this->IdOpérateur;
    }

    /**
     * @param int $IdOpérateur
     */
    public function setIdOpérateur(int $IdOpérateur): void
    {
        $this->IdOpérateur = $IdOpérateur;
    }

    /**
     * @return int
     */
    public function getCodeClient(): int
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
     * @return string
     */
    public function getDateRdv(): string
    {
        return $this->DateRdv;
    }

    /**
     * @param string $DateRdv
     */
    public function setDateRdv(string $DateRdv): void
    {
        $this->DateRdv = $DateRdv;
    }

    /**
     * @return string
     */
    public function getHeureRdv(): string
    {
        return $this->HeureRdv;
    }

    /**
     * @param string $HeureRdv
     */
    public function setHeureRdv(string $HeureRdv): void
    {
        $this->HeureRdv = $HeureRdv;
    }

    /**
     * @return string
     */
    public function getDescriptifDemande(): string
    {
        return $this->Descriptif_demande;
    }

    /**
     * @param string $Descriptif_demande
     */
    public function setDescriptifDemande(string $Descriptif_demande): void
    {
        $this->Descriptif_demande = $Descriptif_demande;
    }

    /**
     * @return float
     */
    public function getKmActuel(): float
    {
        return $this->km_actuel;
    }

    /**
     * @param float $km_actuel
     */
    public function setKmActuel(float $km_actuel): void
    {
        $this->km_actuel = $km_actuel;
    }

    /**
     * @return string
     */
    public function getEtatDemande(): string
    {
        return $this->EtatDemande;
    }

    /**
     * @param string $EtatDemande
     */
    public function setEtatDemande(string $EtatDemande): void
    {
        $this->EtatDemande = $EtatDemande;
    }



}