<?php

class Réaliser_OpDAO extends DAO
{
    public function getOne(int|string $id): array|object
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Réaliser_Op WHERE NoFacture = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Réaliser_Op($row['NoFacture'], $row['CodeOp'], $row['CoutHoraireHT'], $row['Duree_reelle']);
    }

    public function getAll(): array
    {
        /** @var Réaliser_Op[] $res */
        $res = [];
        $stmt = $this->pdo->query("SELECT * FROM Réaliser_Op");
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
            $res[] = new Réaliser_Op($row['NoFacture'], $row['CodeOp'], $row['CoutHoraireHT'], $row['Duree_reelle']);
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