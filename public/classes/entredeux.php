<?php

class entredeux
{
    private int $codeOP;
    private int $codeArticle;

    /**
     * @param int $codeOP
     * @param int $codeArticle
     */
    public function __construct(int $codeOP, int $codeArticle)
    {
        $this->codeOP = $codeOP;
        $this->codeArticle = $codeArticle;
    }

    /**
     * @return int
     */
    public function getCodeOP(): int
    {
        return $this->codeOP;
    }

    /**
     * @param int $codeOP
     */
    public function setCodeOP(int $codeOP): void
    {
        $this->codeOP = $codeOP;
    }

    /**
     * @return int
     */
    public function getCodeArticle(): int
    {
        return $this->codeArticle;
    }

    /**
     * @param int $codeArticle
     */
    public function setCodeArticle(int $codeArticle): void
    {
        $this->codeArticle = $codeArticle;
    }




}