<?php

class DevisDAO extends DAO
{

    public int $lastIdDevis;
    public function getOne(int|string $id): array|object
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Devis WHERE NoDevis = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Devis($row['NoDevis'], $row['NoFacture'], $row['NumDde'], $row['DateDevis'], $row['PrixEstimer'], $row['TauxTva'], $row['estimation_fin']);
    }

    public function getAll(): array
    {
        /** @var Devis[] $res */
        $res = [];
        $stmt = $this->pdo->query("SELECT * FROM Devis");
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
            $res[] = new Devis($row['NoDevis'], $row['NoFacture'], $row['NumDde'], $row['DateDevis'], $row['PrixEstimer'], $row['TauxTva'], $row['estimation_fin']);
        return $res;

    }

    public function insert(object $obj): int
    {
        $stmt = $this->pdo->prepare("INSERT INTO Devis (NoImmatriculation,IdOpérateur,CodeClient, DateRdv,HeureRdv,Descriptif_demande,km_actuel,EtatDemande)"
            . " VALUES (?,?,?,?,?,?,?,?)");
        $res = $stmt->execute([$obj->getNumDde(), $obj->getNoImmatriculation(), $obj->getIdOpérateur(), $obj->getCodeClient(), $obj->getDateRdv(),$obj->getHeureRdv(),$obj->getDescriptifDemande(),$obj->getKmActuel(),$obj->getEtatDemande()]);
        $obj->id = $this->pdo->lastInsertId();
        $this->lastIdDevis=$this->pdo->lastInsertId();
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