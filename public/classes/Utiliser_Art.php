<?php

class Utiliser_Art
{
    private int $NoFacture;
    private int $CodeArticle;
    private int $QteFact;
    private int $PuHT;

    /**
     * @param int $NoFacture
     * @param int $CodeArticle
     * @param int $QteFact
     * @param int $PuHT
     */
    public function __construct(int $NoFacture, int $CodeArticle, int $QteFact, int $PuHT)
    {
        $this->NoFacture = $NoFacture;
        $this->CodeArticle = $CodeArticle;
        $this->QteFact = $QteFact;
        $this->PuHT = $PuHT;
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
    public function getQteFact(): int
    {
        return $this->QteFact;
    }

    /**
     * @param int $QteFact
     */
    public function setQteFact(int $QteFact): void
    {
        $this->QteFact = $QteFact;
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