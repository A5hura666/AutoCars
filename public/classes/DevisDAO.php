<?php

class DevisDAO extends DAO
{
    public function getOne(int|string $id): Devis
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Devis WHERE NoDevis = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Devis($row['NoDevis'], $row['NoFacture'], $row['NumDde'], $row['DateDevis'], $row['PrixEstimer'], $row['TauxTVA'], $row['estimation_fin']);
    }

    public function getAll(): array
    {
        /** @var Devis[] $res */
        $res = [];
        $stmt = $this->pdo->query("SELECT * FROM Devis");
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
            $res[] = new Devis($row['NoDevis'], $row['NoFacture'], $row['NumDde'], $row['DateDevis'], $row['PrixEstimer'], $row['TauxTVA'], $row['estimation_fin']);
        return $res;

    }

    public function insert(object $obj): int
    {
        $stmt = $this->pdo->prepare("INSERT INTO Devis (NoFacture,NumDde, DateDevis,PrixEstimer,TauxTVA,estimation_fin)"
            . " VALUES (?,?,?,?,?,?)");
        $res = $stmt->execute([$obj->getNoFacture(), $obj->getNumDde(), $obj->getDateDevis(), $obj->getPrixEstimer(),$obj->getTauxTva(),$obj->getEstimationFin()]);
        $obj->setNoDevis($this->pdo->lastInsertId());
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