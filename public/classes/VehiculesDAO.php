<?php

class VehiculesDAO extends DAO
{

    public function getOne(int $id): object
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Vehicule WHERE NoImmatriculation = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Vehicule($row['NoImmatriculation'], $row['CodeClient'], $row['NumModele'], $row['NoSerie'], $row['DateMiseEnCirculation']);
    }

    public function getAll(): array
    {
        // TODO: Implement getAll() method.
    }


    public function insert(object $obj): int
    {
        return 0;
        // TODO: Implement insert() method.
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