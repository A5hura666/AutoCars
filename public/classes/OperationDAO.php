<?php

class OperationDAO extends DAO
{

    public function getOne(int|string $id): array|object
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Operation WHERE CodeOp = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Operation($row['CodeOp'], $row['CodeTarif'], $row['LibelleOp'], $row['DureeOp']);
    }

    public function getAll(): array
    {
        /** @var Operation[] $res */
        $res = [];
        $stmt = $this->pdo->query("SELECT * FROM Operation");
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
            $res[] = new Operation($row['CodeOp'], $row['CodeTarif'], $row['LibelleOp'], $row['DureeOp']);
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