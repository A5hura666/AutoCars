<?php

class Prévoir_ArtDAO extends DAO
{

    public function getOne(int|string $id): array|object
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Prévoir_Art WHERE CodeArticle = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Prévoir_Art($row['CodeArticle'], $row['NoDevis'], $row['QtePrevue'], $row['PuHT']);
    }

    public function getAll(): array
    {
        /** @var Prévoir_Art[] $res */
        $res = [];
        $stmt = $this->pdo->query("SELECT * FROM Prévoir_Art");
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
            $res[] = new Prévoir_Art($row['CodeArticle'], $row['NoDevis'], $row['QtePrevue'], $row['PuHT']);
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