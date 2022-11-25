<?php

class UsersDAO extends DAO
{
// Récupération d'un objet Administrateur dont on donne l'identifiant (supposé fiable)

    public function getOne(int $id): Users
    {
        $stmt = $this->pdo->prepare("SELECT * FROM UserRole WHERE idUser = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Users($row['idUser'], $row['$LastName'], $row['FirstName'],$row['Role'] ,$row['Login'], $row['Password']);
    }

    // Récupération de tous les objets dans une table
    public function getAll(): array
    {
        /** @var Users[] $res */
        $res = [];
        $stmt = $this->pdo->query("SELECT * FROM UserRole");
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
            $res[] = new Users($row['idUser'], $row['LastName'], $row['FirstName'],$row['Role'], $row['Login'], $row['Password']);
        return $res;
    }

    // Sauvegarde de l'objet $obj :
    //     $obj->id == UNKNOWN_ID ==> INSERT
    //     $obj->id != UNKNOWN_ID ==> UPDATE

    public function save(object $obj): int {
        if ($obj->idUser == DAO::UNKNOWN_ID) {
            $stmt =  $this->pdo->prepare("INSERT INTO UserRole (LastName, FirstName, Role, Login, Password)"
                . " VALUES (?,?,?,?,?)");
            $res = $stmt->execute([$obj->LastName, $obj->FirstName, $obj->Role, $obj->Login, $obj->Password]);
            $obj->id = $this->pdo->lastInsertId();
        } else {
            $stmt = $this->pdo->prepare("UPDATE UserRole set LastName=:LastName, FirstName=:FirstName, Role=:Role, Login=:Login, Password=:Password"
                . " WHERE idUser=:idUser");
            $res = $stmt->execute(['idUser' => $obj->idUser, 'LastName' => $obj->LastName, 'FirstName' => $obj->FirstName, 'Role' => $obj->Role, 'Login' => $obj->Login, 'Password' => $obj->Password]);
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
            if ($users->getLogin() == $login && $users->getPassword() == $pwd){
                return $users;
            }
        }
        return null;
    }

    public function getNewIdForUser(): int{
        $stmt = $this->pdo->prepare("SELECT idUser from UserRole");
        return $stmt->execute();
    }
}