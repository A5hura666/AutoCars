<?php

class Utiliser_ArtDAO extends DAO
{
    public function getOne(int|string $id): array|object
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Utiliser_Art WHERE NoFacture = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Utiliser_Art($row['NoFacture'], $row['CodeArticle'], $row['QteFact'], $row['PuHT']);
    }

    public function getAll(): array
    {
        /** @var Utiliser_Art[] $res */
        $res = [];
        $stmt = $this->pdo->query("SELECT * FROM Utiliser_Art");
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
            $res[] = new Utiliser_Art($row['NoFacture'], $row['CodeArticle'], $row['QteFact'], $row['PuHT']);
        return $res;
    }

    public function insert(object $obj): int
    {
        // TODO: Implement insert() method.
    }

    public function update(object $obj): int
    {
        // TODO: Implement update() method.
    }

    public function delete(object $obj): int
    {
        // TODO: Implement delete() method.
    }
}