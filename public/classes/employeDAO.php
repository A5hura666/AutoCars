<?php

class employeDAO extends DAO
{
// Récupération d'un objet Administrateur dont on donne l'identifiant (supposé fiable)

    public function getOne(int $idemployé): employe
    {
        $stmt = $this->pdo->prepare("SELECT * FROM employé WHERE idemployé = ?");
        $stmt->execute([$idemployé]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new employe($row['idemployé'], $row['nom'], $row['prénom']);
    }

    // Récupération de tous les objets dans une table
    public function getAll(): array
    {
        $res = array();
        $stmt = $this->pdo->query("SELECT * FROM employé");
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
            $res[] = new employe($row['idemployé'], $row['nom'], $row['prénom']);
        return $res;
    }

    // Sauvegarde de l'objet $obj :
    //     $obj->id == UNKNOWN_ID ==> INSERT
    //     $obj->id != UNKNOWN_ID ==> UPDATE

    public function save(object $obj): int {
        if ($obj->id == DAO::UNKNOWN_ID) {
            $stmt =  $this->pdo->prepare("INSERT INTO employé (nom, prénom)"
                . " VALUES (?,?)");
            $res = $stmt->execute([$obj->nom, $obj->prénom]);
            $obj->id = $this->pdo->lastInsertId();
        } else {
            $stmt = $this->pdo->prepare("UPDATE employé set nom=:nom, prénom=:prénom"
                . " WHERE idemployé=:idemployé");
            $res = $stmt->execute(['idemployé' => $obj->idemployé, 'nom' => $obj->nom, 'prénom' => $obj->prénom]);
        }
        return $res;
    }

    // Effacement de l'objet $obj (DELETE)
    public function delete(object $obj): int {
        $stmt = $this->pdo->prepare("DELETE FROM employé WHERE idemployé = ?");
        return $stmt->execute([$obj->idemployé]);
    }

    public function getlog(): array
    {
        $res = array();
        $stmt = $this->pdo->query("SELECT password, login FROM posseder");
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
            $res = array($row['password'], $row['login']);
        return $res;
    }

    public function check($pwd, $login): ?employe
    {
        foreach ($this->getlog() as $employes) {
            if ($employes->password == $pwd && $employes->login == $login) {
                return $employes;
            }
        }
        return null;
    }
}