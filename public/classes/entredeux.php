<?php

class entredeux
{
    private int $codeOp;
    private int $codeArticle;
    private int $qtt;

    /**
     * @param int $codeOp
     * @param int $codeArticle
     * @param int $qtt
     */
    public function __construct(int $codeOp, int $codeArticle, int $qtt)
    {
        $this->codeOp = $codeOp;
        $this->codeArticle = $codeArticle;
        $this->qtt = $qtt;
    }

    /**
     * @return int
     */
    public function getCodeOp(): int
    {
        return $this->codeOp;
    }

    /**
     * @param int $codeOp
     */
    public function setCodeOp(int $codeOp): void
    {
        $this->codeOp = $codeOp;
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

    /**
     * @return int
     */
    public function getQtt(): int
    {
        return $this->qtt;
    }

    /**
     * @param int $qtt
     */
    public function setQtt(int $qtt): void
    {
        $this->qtt = $qtt;
    }


}