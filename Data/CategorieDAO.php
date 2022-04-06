<?php

declare(strict_types=1);

require_once __DIR__ . "/../Entities/Categorie.php";
require_once __DIR__ . "/DBConfig.php";
require_once __DIR__ . "/../Exceptions/Exceptions.php";

class CategorieDAO
{
    public function getSubCategorieenByHoofdCategorieId(?int $hoofdCategorieId): array
    {
        $sql = "SELECT categorieId, naam
                FROM Categorieen 
                WHERE hoofdCategorieId ";
        if ($hoofdCategorieId === null) {
            $sql .= "is :hoofdCategorieId";
        } else {
            $sql .= "= :hoofdCategorieId";
        }
        try {

            $dbh = new PDO(
                DBConfig::$DB_CONNSTRING,
                DBConfig::$DB_USERNAME,
                DBConfig::$DB_PASSWORD
            );
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $dbh->prepare($sql);
            $stmt->execute(array(':hoofdCategorieId' => $hoofdCategorieId));
            $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $categorieen = [];

            if ($resultSet) {
                foreach ($resultSet as $rij) {
                    $categorie = new Categorie((int)$rij['categorieId'], $rij['naam']);
                    $categorieen[] = $categorie;
                }
            }

            $dbh = null;
            return $categorieen;
        } catch (Exception $e) {
            throw new DBConnectionException($e->getMessage());
        }
    }

    public function getCategorieBySubCategorieId(?int $categorieId): ?Categorie
    {
        if (!$categorieId) return null;
        $sql = "SELECT Categorieen1.categorieId AS categorieId, Categorieen1.naam AS naam
                FROM Categorieen AS Categorieen1 INNER JOIN Categorieen AS Categorieen2
                ON Categorieen1.categorieId = Categorieen2.hoofdCategorieId
                WHERE Categorieen2.categorieId = :categorieId";
        try {

            $dbh = new PDO(
                DBConfig::$DB_CONNSTRING,
                DBConfig::$DB_USERNAME,
                DBConfig::$DB_PASSWORD
            );
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $dbh->prepare($sql);
            $stmt->execute(array(':categorieId' => $categorieId));
            $rij = $stmt->fetch(PDO::FETCH_ASSOC);

            $categorie = null;
            if ($rij) {
                $categorie = new Categorie((int)$rij['categorieId'], $rij['naam']);
            }

            $dbh = null;
            return $categorie;
        } catch (Exception $e) {
            throw new DBConnectionException($e->getMessage());
        }
    }

    public function getCategorieById(?int $categorieId): Categorie
    {
        $sql = "SELECT categorieId, naam
                FROM Categorieen 
                WHERE categorieId = :categorieId";
        try {

            $dbh = new PDO(
                DBConfig::$DB_CONNSTRING,
                DBConfig::$DB_USERNAME,
                DBConfig::$DB_PASSWORD
            );
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $dbh->prepare($sql);
            $stmt->execute(array(':categorieId' => $categorieId));
            $rij = $stmt->fetch(PDO::FETCH_ASSOC);

            $categorie = new Categorie((int)$rij['categorieId'], $rij['naam']);

            $dbh = null;
            return $categorie;
        } catch (Exception $e) {
            throw new DBConnectionException($e->getMessage());
        }
    }
}
