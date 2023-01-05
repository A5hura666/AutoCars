<?php

class FactureDAO extends DAO
{
    public int $lastIdFact=-1;

    public function getOne(int|string $id): array|object
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Facture WHERE NoFacture = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Facture($row['NoFacture'], $row['DateFacture'], $row['TauxTVA'], $row['NetAPayer'], $row['EtatFacture']);
    }

    public function getAll(): array
    {
        /** @var Facture[] $res */
        $res = [];
        $stmt = $this->pdo->query("SELECT * FROM Facture");
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
            $res[] = new Facture($row['NoFacture'], $row['DateFacture'], $row['TauxTVA'], $row['NetAPayer'], $row['EtatFacture']);
        return $res;

    }

    public function insert(object $obj): int
    {
        $stmt = $this->pdo->prepare("INSERT INTO Facture (NoFacture,DateFacture,TauxTVA, NetAPayer,EtatFacture)"
            . " VALUES (?,?,?,?,?)");
        $res = $stmt->execute([$obj->getNoFacture(), $obj->getDateFacture(), $obj->getTauxTVA(), $obj->getNetAPayer(), $obj->getEtatFacture()]);
        $obj->id = $this->pdo->lastInsertId();
        $this->lastIdFact=$this->pdo->lastInsertId();
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