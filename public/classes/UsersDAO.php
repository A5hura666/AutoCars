<?php

class UsersDAO extends DAO
{
// Récupération d'un objet Administrateur dont on donne l'identifiant (supposé fiable)

    public function getOne(int $id): Users
    {
        $stmt = $this->pdo->prepare("SELECT * FROM UserRole WHERE idUser = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Users($row['idUser'], $row['$LastName'], $row['FirstName'], $row['Login'], $row['Password']);
    }

    // Récupération de tous les objets dans une table
    public function getAll(): array
    {
        $res = array();
        $stmt = $this->pdo->query("SELECT * FROM UserRole");
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
            $res[] = new Users($row['idUser'], $row['LastName'], $row['FirstName'], $row['Login'], $row['Password']);
        return $res;
    }

    // Sauvegarde de l'objet $obj :
    //     $obj->id == UNKNOWN_ID ==> INSERT
    //     $obj->id != UNKNOWN_ID ==> UPDATE

    public function save(object $obj): int {
        if ($obj->IdEmployé == DAO::UNKNOWN_ID) {
            $stmt =  $this->pdo->prepare("INSERT INTO UserRole (LastName, FirstName)"
                . " VALUES (?,?)");
            $res = $stmt->execute([$obj->Nom, $obj->Prénom]);
            $obj->id = $this->pdo->lastInsertId();
        } else {
            $stmt = $this->pdo->prepare("UPDATE UserRole set Nom=:Nom, Prénom=:Prénom"
                . " WHERE IdEmployé=:IdEmployé");
            $res = $stmt->execute(['IdEmployé' => $obj->IdEmployé, 'Nom' => $obj->Nom, 'Prénom' => $obj->Prénom]);
        }
        return $res;
    }

    // Effacement de l'objet $obj (DELETE)UserRole
    public function delete(object $obj): int {
        $stmt = $this->pdo->prepare("DELETE FROM UserRole WHERE IdEmployé = ?");
        return $stmt->execute([$obj->IdEmployé]);
    }

    public function check($login,$pwd): ?Users{
        foreach ($this->getAll() as $users){
            if ($users->Login == $login && $users->Password == $pwd ){
                return $users;
            }
        }
        return null;
    }
}