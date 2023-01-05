<?php

class Prévoir_OpDAO extends DAO
{

    public function getOne(int|string $id): array|object
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Prévoir_Op WHERE NoDevis = ?");
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

    public function getOperationForOneDevis(int|string $id):array|object{
        /** @var Prévoir_Op[] $res */
        $res = [];
        $stmt = $this->pdo->prepare("SELECT * FROM Prévoir_Op WHERE NoDevis = ?");
        $stmt->execute([$id]);
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
            $res[] = new Prévoir_Op($row['CodeOp'], $row['NoDevis']);
        return $res;
    }

    public function insert(object $obj): int
    {
        $stmt = $this->pdo->prepare("INSERT INTO Prévoir_Op (CodeOp,NoDevis)"
            . " VALUES (?,?)");
        $res = $stmt->execute([$obj->getCodeOp(), $obj->getNoDevis()]);
        return $res;
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