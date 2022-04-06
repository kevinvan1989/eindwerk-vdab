<?php

declare(strict_types=1);

require_once __DIR__ . "/../Entities/Artikel.php";
require_once __DIR__ . "/DBConfig.php";
require_once __DIR__ . "/../Exceptions/Exceptions.php";

class ArtikelenDAO
{
    public function getBestVerkocht(): array
    {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $sql = "SELECT bestellijnen.artikelId AS id, SUM(aantalBesteld) AS som, ean, naam,
                beschrijving, prijs, gewichtInGram, voorraad, levertijd 
                FROM bestellijnen 
                INNER JOIN artikelen ON bestellijnen.artikelId = artikelen.artikelId 
                GROUP BY id, ean, naam, beschrijving, prijs, gewichtInGram, voorraad, levertijd 
                ORDER BY som DESC";

        $resulSet = $dbh->query($sql);

        $lijst = [];

        foreach ($resulSet as $result) {
            $artikel = new Artikel(
                (int) $result["id"],
                (int) $result["ean"],
                $result["naam"],
                $result["beschrijving"],
                (float) $result["prijs"],
                (int) $result["gewichtInGram"],
                (int) $result["voorraad"],
                (int) $result["levertijd"]
            );
            array_push($lijst, $artikel);
        }

        $dbh = null;

        return $lijst;
    }

    public function getById(?int $id): Artikel
    {
        if ($id === null) {
            return null;
        } else {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

            $sql = "SELECT artikelId, ean, naam, beschrijving, prijs, gewichtInGram, voorraad, levertijd 
                    FROM artikelen WHERE artikelId = :id";
            $command = $dbh->prepare($sql);
            $command->execute(array(":id" => $id));

            $result = $command->fetch(PDO::FETCH_ASSOC);
            $artikel = new Artikel(
                (int) $result["artikelId"],
                (int) $result["ean"],
                $result["naam"],
                $result["beschrijving"],
                (float) $result["prijs"],
                (int) $result["gewichtInGram"],
                (int) $result["voorraad"],
                (int) $result["levertijd"]
            );

            $dbh = null;

            return $artikel;
        }
    }

    public function getByEan(?int $ean): Artikel
    {
        if ($ean === null) {
            return null;
        } else {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

            $sql = "SELECT artikelId, ean, naam, beschrijving, prijs, gewichtInGram, voorraad, levertijd 
                FROM artikelen WHERE ean = :ean";
            $command = $dbh->prepare($sql);
            $command->execute(array(":ean" => $ean));

            $result = $command->fetch(PDO::FETCH_ASSOC);
            $artikel = new Artikel(
                (int) $result["artikelId"],
                (int) $result["ean"],
                $result["naam"],
                $result["beschrijving"],
                (float) $result["prijs"],
                (int) $result["gewichtInGram"],
                (int) $result["voorraad"],
                (int) $result["levertijd"]
            );

            $dbh = null;

            return $artikel;
        }
    }

    public function getArtById_metActueleVoorraad(?int $id): ?Artikel
    {
        if ($id === null) {
            return null;
        } else {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

            $sql = "SELECT artikelen.artikelId as artikelId, ean, artikelen.naam, beschrijving, prijs, gewichtInGram, (voorraad - sum(bestellijnen.aantalBesteld - bestellijnen.aantalGeannuleerd)) as voorraad, levertijd 
                    FROM artikelen
                    inner join bestellijnen 
                    on (artikelen.artikelId = bestellijnen.artikelId)
                    inner join bestellingen
                    on bestellingen.bestelid = bestellijnen.bestelid
                    where artikelen.artikelId = :id AND bestellingsStatusId < 3";

            $command = $dbh->prepare($sql);
            $command->execute(array(":id" => $id));

            $result = $command->fetch(PDO::FETCH_ASSOC);
            if ($result["artikelId"] !== null && $result["voorraad"] !== null) {
                $artikel = new Artikel(
                    (int) $result["artikelId"],
                    (int) $result["ean"],
                    $result["naam"],
                    $result["beschrijving"],
                    (float) $result["prijs"],
                    (int) $result["gewichtInGram"],
                    (int) $result["voorraad"],
                    (int) $result["levertijd"]
                );
            } else {
                return $this->getById($id);
            }
            $dbh = null;

            return $artikel;
        }
    }

    public function getArtikelenByCategorieId(?int $categorieId): array
    {
        $sql = "SELECT Artikelen.artikelId as artikelId, ean, naam, beschrijving, prijs, gewichtInGram, voorraad, levertijd
                from Artikelen inner join ArtikelCategorieen
                on Artikelen.artikelId = ArtikelCategorieen.artikelId 
                where categorieId ";
        if ($categorieId === null) {
            $sql .= "is :categorieId";
        } else {
            $sql .= "= :categorieId";
        }
        try {

            $dbh = new PDO(
                DBConfig::$DB_CONNSTRING,
                DBConfig::$DB_USERNAME,
                DBConfig::$DB_PASSWORD
            );
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $dbh->prepare($sql);
            $stmt->execute(array(':categorieId' => $categorieId));
            $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $artikelen = [];

            if ($resultSet) {
                foreach ($resultSet as $result) {
                    $artikel = new Artikel(
                        (int) $result["artikelId"],
                        (int) $result["ean"],
                        $result["naam"],
                        $result["beschrijving"],
                        (float) $result["prijs"],
                        (int) $result["gewichtInGram"],
                        (int) $result["voorraad"],
                        (int) $result["levertijd"]
                    );
                    $artikelen[] = $artikel;
                }
            }

            $dbh = null;
            return $artikelen;
        } catch (Exception $e) {
            throw new DBConnectionException($e->getMessage());
        }
    }
}
