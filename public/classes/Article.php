<?php

class Article
{
    private int $CodeArticle;
    private string $LibelleArticle;
    private string $TypeArticle;
    private int $PrixUnitActuelHT;
    private int $quantite;

    /**
     * @param int $CodeArticle
     * @param string $LibelleArticle
     * @param string $TypeArticle
     * @param int $PrixUnitActuelHT
     * @param int $quantite
     */
    public function __construct(int $CodeArticle, string $LibelleArticle, string $TypeArticle, int $PrixUnitActuelHT, int $quantite)
    {
        $this->CodeArticle = $CodeArticle;
        $this->LibelleArticle = $LibelleArticle;
        $this->TypeArticle = $TypeArticle;
        $this->PrixUnitActuelHT = $PrixUnitActuelHT;
        $this->quantite = $quantite;
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
     * @return string
     */
    public function getLibelleArticle(): string
    {
        return $this->LibelleArticle;
    }

    /**
     * @param string $LibelleArticle
     */
    public function setLibelleArticle(string $LibelleArticle): void
    {
        $this->LibelleArticle = $LibelleArticle;
    }

    /**
     * @return string
     */
    public function getTypeArticle(): string
    {
        return $this->TypeArticle;
    }

    /**
     * @param string $TypeArticle
     */
    public function setTypeArticle(string $TypeArticle): void
    {
        $this->TypeArticle = $TypeArticle;
    }

    /**
     * @return int
     */
    public function getPrixUnitActuelHT(): int
    {
        return $this->PrixUnitActuelHT;
    }

    /**
     * @param int $PrixUnitActuelHT
     */
    public function setPrixUnitActuelHT(int $PrixUnitActuelHT): void
    {
        $this->PrixUnitActuelHT = $PrixUnitActuelHT;
    }

    /**
     * @return int
     */
    public function getQuantite(): int
    {
        return $this->quantite;
    }

    /**
     * @param int $quantite
     */
    public function setQuantite(int $quantite): void
    {
        $this->quantite = $quantite;
    }



}