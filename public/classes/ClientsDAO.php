<?php

class ClientsDAO extends DAO
{
    public function getOne(int $id): object
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Client WHERE CodeClient = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Client($row['CodeClient'], $row['Nom'], $row['Prénom'], $row['Adresse'], $row['CodePostal'], $row['Ville'],$row['Tel'], $row['mail']);
        //return new Client("","","","","","","","");
    }

    public function getOneByName(string $LastName, string $FirstName){
        $stmt = $this->pdo->prepare("SELECT * FROM Client WHERE Nom = ? and Prénom = ?");
        $stmt->execute([$LastName]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Client($row['CodeClient'], $row['Nom'], $row['Prénom'], $row['Adresse'], $row['CodePostal'], $row['Ville'],$row['Tel'], $row['mail']);
    }

    public function getAll(): array
    {
       /** @var Client[] $res */
        $res = [];
        $stmt = $this->pdo->query("SELECT * FROM Client");
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
            $res[] = new Client($row['CodeClient'], $row['Nom'], $row['Prénom'], $row['Adresse'], $row['CodePostal'], $row['Ville'],$row['Tel'], $row['mail']);
        return $res;
    }

    public function save(object $obj): int
    {
        return 0;
    }

    public function delete(object $obj): int
    {
        return 0;
    }

    public function insert(object $obj): int
    {
        return 0;
        // TODO: Implement insert() method.
    }

    public function update(object $obj): int
    {
        return 0;
        // TODO: Implement update() method.
    }
}