<?php

class ModeleDAO extends DAO
{

    public function getOne(int|string $id): object
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Modele WHERE NumModele = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Modele($row['NumModele'],$row['NumMarque'], $row['Modèle']);
    }

    public function getOneByMarque(string $id): array
    {
        /** @var Modele[] $res */
        $res = [];
        $stmt = $this->pdo->prepare("SELECT * FROM Modele join Marque using(NumMarque) WHERE Marque = ?");
        $stmt->execute([$id]);
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
            $res[] = new Modele($row['NumModele'],$row['NumMarque'],$row['Modèle']);
        return $res;
    }

    public function getAll(): array
    {
        /** @var Modele[] $res */
        $res = [];
        $stmt = $this->pdo->query("SELECT * FROM Modele");
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
            $res[] = new Modele($row['NumModele'],$row['NumMarque'], $row['Modèle']);
        return $res;
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

    public function delete(object $obj): int
    {
        return 0;
        // TODO: Implement delete() method.
    }

}