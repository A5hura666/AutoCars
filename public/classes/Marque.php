<?php

class Marque
{
    private string $NumMarque;
    private string $Marque;

    /**
     * @param string $NumMarque
     * @param string $Marque
     */
    public function __construct(string $NumMarque, string $Marque)
    {
        $this->NumMarque = $NumMarque;
        $this->Marque = $Marque;
    }

    /**
     * @return string
     */
    public function getNumMarque(): string
    {
        return $this->NumMarque;
    }

    /**
     * @param string $NumMarque
     */
    public function setNumMarque(string $NumMarque): void
    {
        $this->NumMarque = $NumMarque;
    }

    /**
     * @return string
     */
    public function getMarque(): string
    {
        return $this->Marque;
    }

    /**
     * @param string $Marque
     */
    public function setMarque(string $Marque): void
    {
        $this->Marque = $Marque;
    }

}