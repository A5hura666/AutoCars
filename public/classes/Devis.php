<?php

class Devis
{
    private int $NoDevis;
    private int $NoFacture;
    private int $NumDde;
    private string $DateDevis;
    private string $PrixEstimer;
    private float $TauxTva;
    private string $estimation_fin;

    /**
     * @param int $NoDevis
     * @param int $NoFacture
     * @param int $NumDde
     * @param string $DateDevis
     * @param string $PrixEstimer
     * @param float $TauxTva
     * @param string $estimation_fin
     */
    public function __construct(int $NoDevis, int $NoFacture, int $NumDde, string $DateDevis, string $PrixEstimer, float $TauxTva, string $estimation_fin)
    {
        $this->NoDevis = $NoDevis;
        $this->NoFacture = $NoFacture;
        $this->NumDde = $NumDde;
        $this->DateDevis = $DateDevis;
        $this->PrixEstimer = $PrixEstimer;
        $this->TauxTva = $TauxTva;
        $this->estimation_fin = $estimation_fin;
    }

    /**
     * @return int
     */
    public function getNoDevis(): int
    {
        return $this->NoDevis;
    }

    /**
     * @param int $NoDevis
     */
    public function setNoDevis(int $NoDevis): void
    {
        $this->NoDevis = $NoDevis;
    }

    /**
     * @return int
     */
    public function getNoFacture(): int
    {
        return $this->NoFacture;
    }

    /**
     * @param int $NoFacture
     */
    public function setNoFacture(int $NoFacture): void
    {
        $this->NoFacture = $NoFacture;
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
    public function getDateDevis(): string
    {
        return $this->DateDevis;
    }

    /**
     * @param string $DateDevis
     */
    public function setDateDevis(string $DateDevis): void
    {
        $this->DateDevis = $DateDevis;
    }

    /**
     * @return string
     */
    public function getPrixEstimer(): string
    {
        return $this->PrixEstimer;
    }

    /**
     * @param string $PrixEstimer
     */
    public function setPrixEstimer(string $PrixEstimer): void
    {
        $this->PrixEstimer = $PrixEstimer;
    }

    /**
     * @return float
     */
    public function getTauxTva(): float
    {
        return $this->TauxTva;
    }

    /**
     * @param float $TauxTva
     */
    public function setTauxTva(float $TauxTva): void
    {
        $this->TauxTva = $TauxTva;
    }

    /**
     * @return string
     */
    public function getEstimationFin(): string
    {
        return $this->estimation_fin;
    }

    /**
     * @param string $estimation_fin
     */
    public function setEstimationFin(string $estimation_fin): void
    {
        $this->estimation_fin = $estimation_fin;
    }



}