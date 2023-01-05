<?php

class Prévoir_Op
{
    private int $CodeOp;
    private int $NoDevis;

    /**
     * @param int $CodeOp
     * @param int $NoDevis
     */
    public function __construct(int $CodeOp, int $NoDevis)
    {
        $this->CodeOp = $CodeOp;
        $this->NoDevis = $NoDevis;
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


}