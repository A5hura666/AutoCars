<?php


class Client
{
    private int $CodeClient;
    private string $LastName;
    private string $FirstName;
    private string $Address;
    private string $CP;
    private string $City;
    private string $Telephone;
    private string $Mail;
    private string $DateCreation;

    /**
     * @param int $CodeClient
     * @param string $LastName
     * @param string $FirstName
     * @param string $Address
     * @param string $CP
     * @param string $City
     * @param string $Telephone
     * @param string $Mail
     * @param string $DateCreation
     */
    public function __construct(int $CodeClient, string $LastName, string $FirstName, string $Address, string $CP, string $City, string $Telephone, string $Mail, string $DateCreation)
    {
        $this->CodeClient = $CodeClient;
        $this->LastName = $LastName;
        $this->FirstName = $FirstName;
        $this->Address = $Address;
        $this->CP = $CP;
        $this->City = $City;
        $this->Telephone = $Telephone;
        $this->Mail = $Mail;
        $this->DateCreation = $DateCreation;
    }

    /**
     * @return string
     */
    public function getDateCreation(): string
    {
        return $this->DateCreation;
    }

    /**
     * @param string $DateCreation
     */
    public function setDateCreation(string $DateCreation): void
    {
        $this->DateCreation = $DateCreation;
    }

    /**
     * @return int
     */
    public function getCodeClient(): int
    {
        return $this->CodeClient;
    }

    /**
     * @param int $CodeClient
     */
    public function setCodeClient(int $CodeClient): void
    {
        $this->CodeClient = $CodeClient;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->LastName;
    }

    /**
     * @param string $LastName
     */
    public function setLastName(string $LastName): void
    {
        $this->LastName = $LastName;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->FirstName;
    }

    /**
     * @param string $FirstName
     */
    public function setFirstName(string $FirstName): void
    {
        $this->FirstName = $FirstName;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->Address;
    }

    /**
     * @param string $Address
     */
    public function setAddress(string $Address): void
    {
        $this->Address = $Address;
    }

    /**
     * @return string
     */
    public function getCP(): string
    {
        return $this->CP;
    }

    /**
     * @param string $CP
     */
    public function setCP(string $CP): void
    {
        $this->CP = $CP;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->City;
    }

    /**
     * @param string $City
     */
    public function setCity(string $City): void
    {
        $this->City = $City;
    }

    /**
     * @return string
     */
    public function getTelephone(): string
    {
        return $this->Telephone;
    }

    /**
     * @param string $Telephone
     */
    public function setTelephone(string $Telephone): void
    {
        $this->Telephone = $Telephone;
    }

    /**
     * @return string
     */
    public function getMail(): string
    {
        return $this->Mail;
    }

    /**
     * @param string $Mail
     */
    public function setMail(string $Mail): void
    {
        $this->Mail = $Mail;
    }




}