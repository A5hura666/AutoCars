<?php

class Réaliser_OpDAO extends DAO
{
    public function getOne(int|string $id): array|object
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Réaliser_Op WHERE NoFacture = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Réaliser_Op($row['NoFacture'], $row['CodeOp']);
    }

    public function getAll(): array
    {
        /** @var Réaliser_Op[] $res */
        $res = [];
        $stmt = $this->pdo->query("SELECT * FROM Réaliser_Op");
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
            $res[] = new Réaliser_Op($row['NoFacture'], $row['CodeOp']);
        return $res;
    }

    public function insert(object $obj): int
    {
        $stmt = $this->pdo->prepare("INSERT INTO Réaliser_Op (NoFacture,CodeOp)"
            . " VALUES (?,?)");
        $res = $stmt->execute([$obj->getNoFacture(), $obj->getCodeOp()]);
        return $res;
    }

    public function getOperationForOneFacture(int|string $id){
        /** @var Réaliser_Op[] $res */
        $stmt = $this->pdo->prepare("SELECT * FROM Réaliser_Op WHERE NoFacture = ?");
        $stmt->execute([$id]);
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
            $res[] = new Réaliser_Op($row['NoFacture'], $row['codeOp']);
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