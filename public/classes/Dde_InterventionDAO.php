<?php

class Dde_InterventionDAO extends DAO
{
    public int $lastIdInterv;
    //Pour le chef d'atelier accès aux rdv
    public function getOne(int|string $id): array|object
    {
        $stmt = $this->pdo->prepare("SELECT * FROM DDE_Intervention WHERE NumDde = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Dde_Intervention($row['NumDde'], $row['NoImmatriculation'], $row['IdOpérateur'], $row['CodeClient'], $row['DateRdv'], $row['HeureRdv'],$row['Descriptif_demande'],$row['km_actuel'],$row['EtatDemande']);
    }

    //Pour l'opérateur voit les rdv assignés
    public function getOneByOp(int|string $id): array|object
    {
        $stmt = $this->pdo->prepare("SELECT * FROM DDE_Intervention WHERE IdOpérateur = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Dde_Intervention($row['NumDde'], $row['NoImmatriculation'], $row['IdOpérateur'], $row['CodeClient'], $row['DateRdv'], $row['HeureRdv'],$row['Descriptif_demande'],$row['km_actuel'],$row['EtatDemande']);
    }

    public function getAll(): array
    {
        /** @var Dde_Intervention[] $res */
        $res = [];
        $stmt = $this->pdo->query("SELECT * FROM DDE_Intervention");
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
            $res[] = new Dde_Intervention($row['NumDde'], $row['NoImmatriculation'], $row['IdOpérateur'], $row['CodeClient'], $row['DateRdv'], $row['HeureRdv'],$row['Descriptif_demande'],$row['km_actuel'],$row['EtatDemande']);
        return $res;
    }

    public function insert(object $obj): int
    {
        $stmt = $this->pdo->prepare("INSERT INTO DDE_Intervention (NoImmatriculation,IdOpérateur,CodeClient, DateRdv,HeureRdv,Descriptif_demande,km_actuel,EtatDemande)"
            . " VALUES (?,?,?,?,?,?,?,?)");
        $res = $stmt->execute([$obj->getNoImmatriculation(), $obj->getIdOpérateur(), $obj->getCodeClient(), $obj->getDateRdv(),$obj->getHeureRdv(),$obj->getDescriptifDemande(),$obj->getKmActuel(),$obj->getEtatDemande()]);
        $obj->setNumDde($this->pdo->lastInsertId());
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