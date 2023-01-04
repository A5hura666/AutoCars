<?php

class Operation
{
    private int $CodeOp;
    private int $CodeTarif;
    private string $LibelleOp;
    private string $DureeOp;
    private string $tarifHoraire;

    /**
     * @param int $CodeOp
     * @param int $CodeTarif
     * @param string $LibelleOp
     * @param string $DureeOp
     */
    public function __construct(int $CodeOp, int $CodeTarif, string $LibelleOp, string $DureeOp, float $tarifHoraire)
    {
        $this->CodeOp = $CodeOp;
        $this->CodeTarif = $CodeTarif;
        $this->LibelleOp = $LibelleOp;
        $this->DureeOp = $DureeOp;
        $this->tarifHoraire = $tarifHoraire;
    }

    /**
     * @return int
     */
    public function getCodeOp(): int
    {
        return $this->CodeOp;
    }

    /**
     * @param int $CodeOp
     */
    public function setCodeOp(int $CodeOp): void
    {
        $this->CodeOp = $CodeOp;
    }

    /**
     * @return int
     */
    public function getCodeTarif(): int
    {
        return $this->CodeTarif;
    }

    /**
     * @param int $CodeTarif
     */
    public function setCodeTarif(int $CodeTarif): void
    {
        $this->CodeTarif = $CodeTarif;
    }

    /**
     * @return string
     */
    public function getLibelleOp(): string
    {
        return $this->LibelleOp;
    }

    /**
     * @param string $LibelleOp
     */
    public function setLibelleOp(string $LibelleOp): void
    {
        $this->LibelleOp = $LibelleOp;
    }

    /**
     * @return string
     */
    public function getDureeOp(): string
    {
        return $this->DureeOp;
    }

    /**
     * @param string $DureeOp
     */
    public function setDureeOp(string $DureeOp): void
    {
        $this->DureeOp = $DureeOp;
    }

    /**
     * @return string
     */
    public function getTarifHoraire(): string
    {
        return $this->tarifHoraire;
    }

    /**
     * @param string $tarifHoraire
     */
    public function setTarifHoraire(string $tarifHoraire): void
    {
        $this->tarifHoraire = $tarifHoraire;
    }




}