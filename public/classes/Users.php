<?php

class Users
{
    public int $idUser;
    public string $LastName;
    public string $FirstName;
    public string $Login;
    public string $Password;


    /**
     * @param int $idUser
     * @param string $LastName
     * @param string $FirstName
     * @param string $Login
     * @param string $Password
     */
    public function __construct(int $idUser, string $LastName, string $FirstName, string $Login, string $Password)
    {
        $this->idUser = $idUser;
        $this->LastName = $LastName;
        $this->FirstName = $FirstName;
        $this->Login = $Login;
        $this->Password = $Password;

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

    /**
     * @return string[]
     */
    public function getRole(): array|string
    {
        return $this->Role;
    }

    /**
     * @param string[] $Role
     */
    public function setRole(array|string $Role): void
    {
        $this->Role = $Role;
    }

}