<?php

class Réaliser_Op
{
    private int $NoFacture;
    private int $CodeOp;

    /**
     * @param int $NoFacture
     * @param int $CodeOp
     */
    public function __construct(int $NoFacture, int $CodeOp)
    {
        $this->NoFacture = $NoFacture;
        $this->CodeOp = $CodeOp;
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

}