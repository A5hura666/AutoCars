<?php

class ClientsDAO extends DAO
{


    public function getOne(int $id): object
    {
        return new Client("","","","","","","","");
    }

    public function getAll(): array
    {
      // /** @var Client[] $res */
      //  $res = [];
      //  $stmt = $this->pdo->query("SELECT * FROM Client");
      //  foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
      //      $res = new Client($row['CodeClient'], $row['LastName'], $row['FirstName'], $row['Address'], $row['CP'], $row['City'], $row['Telephone'], $row['Mail']);
        return [];
    }

    public function save(object $obj): int
    {
        return 0;
    }

    public function delete(object $obj): int
    {
        return 0;
    }
}