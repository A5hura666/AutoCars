<?php

class UsersDAO extends DAO
{
// Récupération d'un objet Administrateur dont on donne l'identifiant (supposé fiable)

    public function getOne(int|string $id): Users
    {
        $stmt = $this->pdo->prepare("SELECT * FROM UserRole WHERE idUser = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Users($row['idUser'], $row['LastName'], $row['FirstName'], $row['Role'], $row['Login'], $row['Password']);
    }

    // Récupération de tous les objets dans une table
    public function getAll(): array
    {
        /** @var Users[] $res */
        $res = [];
        $stmt = $this->pdo->query("SELECT * FROM UserRole");
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
            $res[] = new Users($row['idUser'], $row['LastName'], $row['FirstName'], $row['Role'], $row['Login'], $row['Password']);
        return $res;
    }

    public function getOneByName(string $LastName, string $FirstName): Users{
        $stmt = $this->pdo->prepare("SELECT * FROM UserRole WHERE LastName = ? and FirstName = ?");
        $stmt->execute([$LastName,$FirstName]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return  new Users($row['idUser'], $row['LastName'], $row['FirstName'], $row['Role'], $row['Login'], $row['Password']);
    }

    public function getAllOperator(): array
    {
        /** @var Users[] $res */
        $res = [];
        $stmt = $this->pdo->query("SELECT * FROM UserRole where Role='Opérateur' ");
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
            $res[] = new Users($row['idUser'], $row['LastName'], $row['FirstName'], $row['Role'], $row['Login'], $row['Password']);
        return $res;
    }

    // Sauvegarde de l'objet $obj :
    //     $obj->id == UNKNOWN_ID ==> INSERT
    //     $obj->id != UNKNOWN_ID ==> UPDATE

/*    public function save(object $obj): int
    {
        if ($obj->getIdUser() == DAO::UNKNOWN_ID) {
            $stmt = $this->pdo->prepare("INSERT INTO UserRole (LastName, FirstName, Role, Login, Password)"
                . " VALUES (?,?,?,?,?)");
            $res = $stmt->execute([$obj->getLastName(), $obj->getFirstName(), $obj->getRole(), $obj->getLogin(), $obj->getPassword()]);
            $obj->id = $this->pdo->lastInsertId();
        } else {
            $stmt = $this->pdo->prepare("UPDATE UserRole set LastName=:LastName, FirstName=:FirstName, Role=:Role, Login=:Login, Password=:Password"
                . " WHERE idUser=:idUser");
            $res = $stmt->execute(['idUser' => $obj->getIdUser(), 'LastName' => $obj->getLastName(), 'FirstName' => $obj->getFirstName(), 'Role' => $obj->getRole(), 'Login' => $obj->getLogin(), 'Password' => $obj->getPassword()]);
        }
        return $res;
    }
*/

    public function insert(object $obj): int{
            $stmt = $this->pdo->prepare("INSERT INTO UserRole (LastName, FirstName, Role, Login, Password)"
                . " VALUES (?,?,?,?,?)");
            $res = $stmt->execute([$obj->getLastName(), $obj->getFirstName(), $obj->getRole(), $obj->getLogin(), $obj->getPassword()]);
            $obj->id = $this->pdo->lastInsertId();
        return $res;
    }

    public function update(object $obj): int{
        $stmt = $this->pdo->prepare("UPDATE UserRole set LastName=:LastName, FirstName=:FirstName, Role=:Role, Login=:Login, Password=:Password"
            . " WHERE idUser=:idUser");
        $res = $stmt->execute(['idUser' => $obj->getIdUser(), 'LastName' => $obj->getLastName(), 'FirstName' => $obj->getFirstName(), 'Role' => $obj->getRole(), 'Login' => $obj->getLogin(), 'Password' => $obj->getPassword()]);
        return $res;
    }

    // Effacement de l'objet $obj (DELETE)UserRole
    public function delete(object $obj): int
    {
        $stmt = $this->pdo->prepare("DELETE FROM UserRole WHERE idUser = ?");
        return $stmt->execute([$obj->idUser]);
    }

    public function check($login, $pwd): ?Users
    {
        password_hash($pwd,PASSWORD_ARGON2ID);
        foreach ($this->getAll() as $users) {
            if ($users->getLogin() == $login && password_verify($pwd,$users->getPassword())) {//Check version hachage sécurisé
                return $users;
            }if ($users->getLogin() == $login && $users->getPassword() == $pwd){//Check version simple sans sécurité
                return $users;
            }
        }
        return null;
    }
}