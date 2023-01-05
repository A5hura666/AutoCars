<?php

class Prévoir_Op
{
    private int $CodeOp;
    private int $NoDevis;
    private int $CoutHoraireHT;
    private string $Duree_prevue;

    /**
     * @param int $CodeOp
     * @param int $NoDevis
     * @param int $CoutHoraireHT
     * @param string $Duree_prevue
     */
    public function __construct(int $CodeOp, int $NoDevis, int $CoutHoraireHT, string $Duree_prevue)
    {
        $this->CodeOp = $CodeOp;
        $this->NoDevis = $NoDevis;
        $this->CoutHoraireHT = $CoutHoraireHT;
        $this->Duree_prevue = $Duree_prevue;
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
    public function getDureePrevue(): string
    {
        return $this->Duree_prevue;
    }

    /**
     * @param string $Duree_prevue
     */
    public function setDureePrevue(string $Duree_prevue): void
    {
        $this->Duree_prevue = $Duree_prevue;
    }

}