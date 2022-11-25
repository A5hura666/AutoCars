<?php

class Users
{
    private int $idUser;
    private string $LastName;
    private string $FirstName;
    private string $Role;
    private string $Login;
    private string $Password;

    const ADMINISTRATEUR="Administrateur";
    const CHEF_ATELIER="Chef d'atelier";
    const OPERATEUR="Opérateur";

    /**
     * @param int $idUser
     * @param string $LastName
     * @param string $FirstName
     * @param string $Role
     * @param string $Login
     * @param string $Password
     */
    public function __construct(int $idUser, string $LastName, string $FirstName, string $Role, string $Login, string $Password)
    {
        $this->idUser = $idUser;
        $this->LastName = $LastName;
        $this->FirstName = $FirstName;
        $this->Role = $Role;
        $this->Login = $Login;
        $this->Password = $Password;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->Role;
    }

    /**
     * @param string $Role
     */
    public function setRole(string $Role): void
    {
        $this->Role = $Role;
    }

    /**
     * @return int
     */
    public function getIdUser(): int
    {
        return $this->idUser;
    }

    /**
     * @param int $idUser
     */
    public function setIdUser(int $idUser): void
    {
        $this->idUser = $idUser;
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
    public function getLogin(): string
    {
        return $this->Login;
    }

    /**
     * @param string $Login
     */
    public function setLogin(string $Login): void
    {
        $this->Login = $Login;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->Password;
    }

    /**
     * @param string $Password
     */
    public function setPassword(string $Password): void
    {
        $this->Password = $Password;
    }

}