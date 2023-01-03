<?php

class VehiculesDAO extends DAO
{

    public function getOne(int|string $id): Vehicule
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Vehicule join Modele using(NumModele) join Marque using(NumMarque) WHERE NoImmatriculation = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Vehicule($row['NoImmatriculation'], $row['CodeClient'], $row['NumModele'], $row['NoSerie'], $row['DateMiseEnCirculation'],$row['NumMarque']);
    }

    public function getByIdClient(int $id): Vehicule
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Vehicule join Client using(CodeClient) join Modele using(NumModele) join Marque using(NumMarque) WHERE CodeClient = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Vehicule($row['NoImmatriculation'], $row['CodeClient'], $row['NumModele'], $row['NoSerie'], $row['DateMiseEnCirculation'],$row['NumMarque']);
    }

    public function getAll(): array
    {
        /** @var Vehicule[] $res */
        $res = [];
        $stmt = $this->pdo->query("SELECT * FROM Vehicule join Modele using(NumModele) join Marque using(NumMarque)");
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
            $res[] = new Vehicule($row['NoImmatriculation'], $row['CodeClient'], $row['NumModele'], $row['NoSerie'], $row['DateMiseEnCirculation'],$row['NumMarque']);
        return $res;
    }

    public function insert(object $obj): int
    {
        /** @var Vehicule $obj */
        $stmt = $this->pdo->prepare("INSERT INTO Vehicule (NoImmatriculation, CodeClient, Modele, NoSerie, DateMiseEnCirculation, Marque)"
            . " VALUES (?,?,?,?,?,?)");
        $res = $stmt->execute([$obj->getNoImmatriculation(), $obj->getCodeClient(), $obj->getNumModele(), $obj->getNoSerie(), $obj->getDateMiseEnCirculation(),$obj->getMarque()]);
        return $res;
    }

    public function update(object $obj): int
    {
        return 0;
        // TODO: Implement update() method.
    }

    public function delete(object $obj): int
    {
        return 0;
        // TODO: Implement delete() method.
    }


}