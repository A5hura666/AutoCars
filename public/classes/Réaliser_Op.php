<?php

class Réaliser_Op
{
    private int $NoFacture;
    private int $CodeOp;
    private int $CoutHoraireHT;
    private string $Duree_reelle;

    /**
     * @param int $NoFacture
     * @param int $CodeOp
     * @param int $CoutHoraireHT
     * @param string $Duree_reelle
     */
    public function __construct(int $NoFacture, int $CodeOp, int $CoutHoraireHT, string $Duree_reelle)
    {
        $this->NoFacture = $NoFacture;
        $this->CodeOp = $CodeOp;
        $this->CoutHoraireHT = $CoutHoraireHT;
        $this->Duree_reelle = $Duree_reelle;
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
    public function getCoutHoraireHT(): int
    {
        return $this->CoutHoraireHT;
    }

    /**
     * @param int $CoutHoraireHT
     */
    public function setCoutHoraireHT(int $CoutHoraireHT): void
    {
        $this->CoutHoraireHT = $CoutHoraireHT;
    }

    /**
     * @return string
     */
    public function getDureeReelle(): string
    {
        return $this->Duree_reelle;
    }

    /**
     * @param string $Duree_reelle
     */
    public function setDureeReelle(string $Duree_reelle): void
    {
        $this->Duree_reelle = $Duree_reelle;
    }


}