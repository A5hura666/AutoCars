<?php

class FactureDAO extends DAO
{
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
        $stmt = $this->pdo->prepare("INSERT INTO Facture (DateFacture,TauxTVA, NetAPayer,EtatFacture)"
            . " VALUES (?,?,?,?)");
        $res = $stmt->execute([$obj->getDateFacture(), $obj->getTauxTVA(), $obj->getNetAPayer(), $obj->getEtatFacture()]);
        $obj->setNoFacture($this->pdo->lastInsertId());
        return $res;
    }

    public function update(object $obj): int
    {
        $stmt = $this->pdo->prepare("UPDATE Facture set NoFacture=:NoFacture, DateFacture=:DateFacture, TauxTVA=:TauxTVA, NetAPayer=:NetAPayer, EtatFacture=:EtatFacture WHERE NoFacture=:NoFacture");
        $res = $stmt->execute(['NoFacture' => $obj->getNoFacture(), 'DateFacture' => $obj->getDateFacture(), 'TauxTVA' => $obj->getTauxTVA(), 'NetAPayer' => $obj->getNetAPayer(), 'EtatFacture' => $obj->getEtatFacture()]);
        return $res;
    }

    public function delete(object $obj): int
    {
        // TODO: Implement delete() method.
    }
}