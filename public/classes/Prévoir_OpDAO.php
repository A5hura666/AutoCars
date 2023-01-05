<?php

class Prévoir_OpDAO extends DAO
{

    public function getOne(int|string $id): array|object
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Prévoir_Op WHERE CodeOp = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Prévoir_Op($row['CodeOp'], $row['NoDevis']);
    }

    public function getAll(): array
    {
        /** @var Prévoir_Op[] $res */
        $res = [];
        $stmt = $this->pdo->query("SELECT * FROM Prévoir_Op");
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
            $res[] = new Prévoir_Op($row['CodeOp'], $row['NoDevis']);
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