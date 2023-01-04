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

    public function insert(object $obj): int
    {
        // TODO: Implement insert() method.
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