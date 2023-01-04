<?php

class entredeuxDAO extends DAO
{

    public function getOne(int|string $id): array
    {
        /** @var entredeux[] $res */
        $stmt = $this->pdo->query("SELECT * FROM entredeux WHERE codeOp = ?");
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
            $res[] = new entredeux($row['codeOp'], $row['codeArticle'], $row['qtt']);
        return $res;
    }

    public function TrueGetOne(int $op, int $Art){
        $stmt = $this->pdo->prepare("SELECT * FROM entredeux WHERE codeOp = ? and codeArticle = ?");
        $stmt->execute([$op,$Art]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new entredeux($row['codeOp'], $row['codeArticle'], $row['qtt']);
    }

    public function getAll(): array
    {
        /** @var entredeux[] $res */
        $res = [];
        $stmt = $this->pdo->query("SELECT * FROM entredeux");
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
            $res[] = new entredeux($row['codeOp'], $row['codeArticle'], $row['qtt']);
        return $res;
    }

    public function insert(object $obj): int
    {
        $stmt = $this->pdo->prepare("INSERT INTO entredeux (codeOp, codeArticle, qtt)"
            . " VALUES (?,?,?)");
        $res = $stmt->execute([$obj->getCodeTarif(), $obj->getLibelleOp(), $obj->getDureeOp()]);
        $obj->id = $this->pdo->lastInsertId();
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