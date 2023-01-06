<?php

class ArticleDAO extends DAO
{

    public function getOne(int|string $id): object
    {
        /** @var entredeux[] $res */
        $stmt = $this->pdo->prepare("SELECT * FROM Article WHERE CodeArticle = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Article($row['CodeArticle'], $row['LibelleArticle'], $row['TypeArticle'], $row['PrixUnitActuelHT'], $row['quantite']);
    }

    public function getOnebyId(int|string $id): Article
    {
        /** @var entredeux[] $res */
        $stmt = $this->pdo->prepare("SELECT * FROM Article WHERE CodeArticle = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Article($row['CodeArticle'], $row['LibelleArticle'], $row['TypeArticle'], $row['PrixUnitActuelHT'], $row['quantite']);
    }

    public function getOneByName(int|string $id): Article
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Article WHERE LibelleArticle = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Article($row['CodeArticle'], $row['LibelleArticle'], $row['TypeArticle'], $row['PrixUnitActuelHT'], $row['quantite']);
    }

    public function getAll(): array
    {
        /** @var Article[] $res */
        $res = [];
        $stmt = $this->pdo->query("SELECT * FROM Article");
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
            $res[] = new Article($row['CodeArticle'], $row['LibelleArticle'], $row['TypeArticle'], $row['PrixUnitActuelHT'], $row['quantite']);
        return $res;
    }

    public function getAllSort(): array
    {
        /** @var Article[] $res */
        $res = [];
        $stmt = $this->pdo->query("SELECT * FROM Article ORDER BY quantite asc");
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
            $res[] = new Article($row['CodeArticle'], $row['LibelleArticle'], $row['TypeArticle'], $row['PrixUnitActuelHT'], $row['quantite']);
        return $res;
    }
    public function getAllFromOneRealiserOp(Réaliser_Op $obj): array
    {
        /** @var Article[] $res */
        $res = [];
        $stmt = $this->pdo->prepare("SELECT a.* FROM Article a JOIN entredeux e USING (CodeArticle) JOIN Operation O USING (CodeOp) JOIN Réaliser_Op R USING (CodeOp) WHERE R.NoFacture=? and R.CodeOp = ?;");
        $stmt->execute([$obj->getNoFacture(),$obj->getCodeOp()]);
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
            $res[] = new Article($row['CodeArticle'], $row['LibelleArticle'], $row['TypeArticle'], $row['PrixUnitActuelHT'], $row['quantite']);
        return $res;
    }


    public function insert(object $obj): int
    {
    }

    public function update(object $obj): int
    {
        $stmt = $this->pdo->prepare("UPDATE Article set CodeArticle=:CodeArticle, LibelleArticle=:LibelleArticle, TypeArticle=:TypeArticle, PrixUnitActuelHT=:PrixUnitActuelHT, quantite=:quantite WHERE CodeArticle=:CodeArticle");
        $res = $stmt->execute(['CodeArticle' => $obj->getCodeArticle(), 'LibelleArticle' => $obj->getLibelleArticle(), 'TypeArticle' => $obj->getTypeArticle(), 'PrixUnitActuelHT' => $obj->getPrixUnitActuelHT(), 'quantite' => $obj->getQuantite()]);
        return $res;
    }

    public function delete(object $obj): int
    {
    }
}