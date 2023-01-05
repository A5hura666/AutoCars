<?php

class OperationDAO extends DAO
{
    public int $lastIdOp = -1;

    public function getOne(int|string $id): array|object
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Operation join Tarif_Mo using(CodeTarif) WHERE CodeOp = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Operation($row['CodeOp'], $row['CodeTarif'], $row['LibelleOp'], $row['DureeOp'], $row['CoutHoraireActuelHT']);
    }

    public function getAll(): array
    {
        /** @var Operation[] $res */
        $res = [];
        $stmt = $this->pdo->query("SELECT * FROM Operation join Tarif_Mo using(CodeTarif)");
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
            $res[] = new Operation($row['CodeOp'], $row['CodeTarif'], $row['LibelleOp'], $row['DureeOp'], $row['CoutHoraireActuelHT']);
        return $res;
    }

    public function getOneByLibOP(int|string $lib): Operation
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Operation join Tarif_Mo using(CodeTarif) WHERE LibelleOp = ?");
        $stmt->execute([$lib]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Operation($row['CodeOp'], $row['CodeTarif'], $row['LibelleOp'], $row['DureeOp'], $row['CoutHoraireActuelHT']);
    }

    public function insert(object $obj): int
    {
        $stmt = $this->pdo->prepare("INSERT INTO Operation (CodeTarif, LibelleOp, DureeOp)"
            . " VALUES (?,?,?)");
        $res = $stmt->execute([$obj->getCodeTarif(), $obj->getLibelleOp(), $obj->getDureeOp()]);
        $obj->setCodeOp($this->pdo->lastInsertId());
        return $res;
    }

    public function update(object $obj): int
    {
        $stmt = $this->pdo->prepare("UPDATE Operation set CodeTarif=:CodeTarif, LibelleOp=:LibelleOp, DureeOp=:DureeOp"
            . " WHERE CodeOp=:CodeOp");
        $res = $stmt->execute(['CodeOp' => $obj->getCodeOp(), 'CodeTarif' => $obj->getCodeTarif(), 'LibelleOp' => $obj->getLibelleOp(), 'DureeOp' => $obj->getDureeOp()]);
        return $res;
    }

    public function delete(object $obj): int
    {
        $stmt = $this->pdo->prepare("DELETE FROM Operation WHERE CodeOp = ?");
        $res = $stmt->execute([$obj->getCodeOp()]);
        return $res;
    }
}