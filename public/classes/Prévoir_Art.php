<?php

class Prévoir_Art
{
    private int $CodeArticle;
    private int $NoDevis;
    private int $QtePrevue;
    private int $PuHT;

    /**
     * @param int $CodeArticle
     * @param int $NoDevis
     * @param $QtePrevue
     * @param int $PuHT
     */
    public function __construct(int $CodeArticle, int $NoDevis, $QtePrevue, int $PuHT)
    {
        $this->CodeArticle = $CodeArticle;
        $this->NoDevis = $NoDevis;
        $this->QtePrevue = $QtePrevue;
        $this->PuHT = $PuHT;
    }

    /**
     * @return int
     */
    public function getCodeArticle(): int
    {
        return $this->CodeArticle;
    }

    /**
     * @param int $CodeArticle
     */
    public function setCodeArticle(int $CodeArticle): void
    {
        $this->CodeArticle = $CodeArticle;
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
    public function getQtePrevue(): int
    {
        return $this->QtePrevue;
    }

    /**
     * @param int $QtePrevue
     */
    public function setQtePrevue(int $QtePrevue): void
    {
        $this->QtePrevue = $QtePrevue;
    }

    /**
     * @return int
     */
    public function getPuHT(): int
    {
        return $this->PuHT;
    }

    /**
     * @param int $PuHT
     */
    public function setPuHT(int $PuHT): void
    {
        $this->PuHT = $PuHT;
    }

}