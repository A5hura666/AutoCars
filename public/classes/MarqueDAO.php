<?php

class MarqueDAO extends DAO
{

    public function getOne(int|string $id): Marque
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Marque WHERE NumMarque = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Marque($row['NumMarque'], $row['Marque']);
    }

    public function getAll(): array
    {
        /** @var Marque[] $res */
        $res = [];
        $stmt = $this->pdo->query("SELECT * FROM Marque");
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
            $res[] = new Marque($row['NumMarque'], $row['Marque']);
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