<?php

class ClientsDAO extends DAO
{
    public function getOne(int|string $id): Client
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Client WHERE CodeClient = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Client($row['CodeClient'], $row['Nom'], $row['Prénom'], $row['Adresse'], $row['CodePostal'], $row['Ville'],$row['Tel'], $row['mail'], $row["DateCreation"]);
    }

    public function getOneByName(string $LastName, string $FirstName): Client{
        $stmt = $this->pdo->prepare("SELECT * FROM Client WHERE Nom = ? and Prénom = ?");
        $stmt->execute([$LastName,$FirstName]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Client($row['CodeClient'], $row['Nom'], $row['Prénom'], $row['Adresse'], $row['CodePostal'], $row['Ville'],$row['Tel'], $row['mail'], $row["DateCreation"]);
    }

    public function getAll(): array
    {
       /** @var Client[] $res */
        $res = [];
        $stmt = $this->pdo->query("SELECT * FROM Client");
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
            $res[] = new Client($row['CodeClient'], $row['Nom'], $row['Prénom'], $row['Adresse'], $row['CodePostal'], $row['Ville'],$row['Tel'], $row['mail'], $row["DateCreation"]);
        return $res;
    }

    /*public function save(object $obj): int
    {
        $stmt = $this->pdo->prepare("INSERT INTO Client (LastName, FirstName, Role, Login, Password)"
            . " VALUES (?,?,?,?,?)");
        $res = $stmt->execute([$obj->getLastName(), $obj->getFirstName(), $obj->getRole(), $obj->getLogin(), $obj->getPassword()]);
        $obj->id = $this->pdo->lastInsertId();
        return $res;
    }*/

    public function delete(object $obj): int
    {
        return 0;
    }

    public function insert(object $obj): int
    {
        /** @var Client $obj */
        $stmt = $this->pdo->prepare("INSERT INTO Client (Nom, Prénom, Adresse, CodePostal, Ville, Tel ,mail, DateCreation)"
            . " VALUES (?,?,?,?,?,?,?,?)");
        $res = $stmt->execute([$obj->getLastName(), $obj->getFirstName(), $obj->getAddress(), $obj->getCP(), $obj->getCity(),$obj->getTelephone(),$obj->getMail(),$obj->getDateCreation()]);
        $obj->id = $this->pdo->lastInsertId();
        return $res;
    }

    public function update(object $obj): int
    {
        $stmt = $this->pdo->prepare("UPDATE Client set LastName=:LastName, FirstName=:FirstName, Role=:Role, Login=:Login, Password=:Password"
            . " WHERE idUser=:idUser");
        $res = $stmt->execute(['idUser' => $obj->getIdUser(), 'LastName' => $obj->getLastName(), 'FirstName' => $obj->getFirstName(), 'Role' => $obj->getRole(), 'Login' => $obj->getLogin(), 'Password' => $obj->getPassword()]);
        return $res;
    }
}