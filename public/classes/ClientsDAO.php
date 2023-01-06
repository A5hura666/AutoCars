<?php

class ClientsDAO extends DAO
{
    public int $lastId = -1;

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
        $stmt = $this->pdo->prepare("DELETE FROM Client WHERE CodeClient=:CodeClient");
        $res = $stmt->execute(['CodeClient'=>$obj->getCodeClient]);
        return $res;
    }

    public function insert(object $obj): int
    {
        /** @var Client $obj */
        $stmt = $this->pdo->prepare("INSERT INTO Client (Nom, Prénom, Adresse, CodePostal, Ville, Tel ,mail, DateCreation)"
            . " VALUES (?,?,?,?,?,?,?,?)");
        $res = $stmt->execute([$obj->getLastName(), $obj->getFirstName(), $obj->getAddress(), $obj->getCP(), $obj->getCity(),$obj->getTelephone(),$obj->getMail(),$obj->getDateCreation()]);
        $obj->id = $this->pdo->lastInsertId();
        $this->lastId = $this->pdo->lastInsertId();
        return $res;
    }

    public function update(object $obj): int
    {
        $stmt = $this->pdo->prepare("UPDATE Client set Nom=:Nom, Prénom=:Prénom, Adresse=:Adresse, CodePostal=:CodePostal,Ville=:Ville,Tel=:Tel,mail=:mail,DateCreation=:DateCreation WHERE CodeClient=:CodeClient");
        $res = $stmt->execute([ 'Nom' => $obj->getLastName(), 'Prénom' => $obj->getFirstName(), 'Adresse' => $obj->getAddress(), 'CodePostal' => $obj->getCP(), 'Ville' => $obj->getCity(),'Tel' => $obj->getTelephone(),'mail'=>$obj->getMail(),'DateCreation' => $obj->getDateCreation(),'CodeClient' => $obj->getCodeClient()]);
        return $res;
    }
}
