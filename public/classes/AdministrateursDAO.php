<?php
// Classe pour l'accès à la table Contacts
class AdministrateursDAO extends DAO {

    // Récupération d'un objet Administrateur dont on donne l'identifiant (supposé fiable)
    public function getOne(int $id): Administrateur {
        $stmt = $this->pdo->prepare("SELECT * FROM Administrateurs WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Administrateur($row['id'], $row['login'], $row['mdp']);
    }

    // Récupération de tous les objets dans une table
    public function getAll(): array {
        $res = array();
        $stmt = $this->pdo->query("SELECT * FROM Administrateurs");
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
            $res[] = new Administrateur($row['id'], $row['login'], $row['mdp']);
        return $res;
    }

    // Sauvegarde de l'objet $obj :
    //     $obj->id == UNKNOWN_ID ==> INSERT
    //     $obj->id != UNKNOWN_ID ==> UPDATE
    public function save(object $obj): int {
        if ($obj->id == DAO::UNKNOWN_ID) {
            $stmt =  $this->pdo->prepare("INSERT INTO Administrateurs (login, mdp)"
                                         . " VALUES (?,?)");
            $res = $stmt->execute([$obj->login, $obj->mdp]);
            $obj->id = $this->pdo->lastInsertId();
        } else {
            $stmt = $this->pdo->prepare("UPDATE Administrateurs set login=:login, mdp=:mdp"
                                        . " WHERE id=:id");
            $res = $stmt->execute(['id' => $obj->id, 'login' => $obj->login, 'mdp' => $obj->mdp]);
        }
        return $res;
    }

    // Effacement de l'objet $obj (DELETE)
    public function delete(object $obj): int {
        $stmt = $this->pdo->prepare("DELETE FROM Administrateurs WHERE id = ?");
        return $stmt->execute([$obj->id]);
    }

    public function check($login,$pwd): ?Administrateur{
        foreach ($this->getAll() as $admin){
            if ($admin->login==$login && $admin->mdp==$pwd ){
                return $admin;
            }
        }
        return null;
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
}
