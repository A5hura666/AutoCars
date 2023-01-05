<?php

class Facture
{
    private int $NoFacture;
    private string $DateFacture;
    private float $TauxTVA;
    private float $NetAPayer;
    private string $EtatFacture;

    /**
     * @param int $NoFacture
     * @param string $DateFacture
     * @param float $TauxTVA
     * @param float $NetAPayer
     * @param string $EtatFacture
     */
    public function __construct(int $NoFacture, string $DateFacture, float $TauxTVA, float $NetAPayer, string $EtatFacture)
    {
        $this->NoFacture = $NoFacture;
        $this->DateFacture = $DateFacture;
        $this->TauxTVA = $TauxTVA;
        $this->NetAPayer = $NetAPayer;
        $this->EtatFacture = $EtatFacture;
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
     * @return string
     */
    public function getDateFacture(): string
    {
        return $this->DateFacture;
    }

    /**
     * @param string $DateFacture
     */
    public function setDateFacture(string $DateFacture): void
    {
        $this->DateFacture = $DateFacture;
    }

    /**
     * @return float
     */
    public function getTauxTVA(): float
    {
        return $this->TauxTVA;
    }

    /**
     * @param float $TauxTVA
     */
    public function setTauxTVA(float $TauxTVA): void
    {
        $this->TauxTVA = $TauxTVA;
    }

    /**
     * @return float
     */
    public function getNetAPayer(): float
    {
        return $this->NetAPayer;
    }

    /**
     * @param float $NetAPayer
     */
    public function setNetAPayer(float $NetAPayer): void
    {
        $this->NetAPayer = $NetAPayer;
    }

    /**
     * @return string
     */
    public function getEtatFacture(): string
    {
        return $this->EtatFacture;
    }

    /**
     * @param string $EtatFacture
     */
    public function setEtatFacture(string $EtatFacture): void
    {
        $this->EtatFacture = $EtatFacture;
    }




}