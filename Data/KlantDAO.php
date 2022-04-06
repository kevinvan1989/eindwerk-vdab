<?php

declare(strict_types=1);

require_once __DIR__ . "/DBConfig.php";
require_once __DIR__ . "/../Entities/Klant.php";
require_once __DIR__ . "/../Exceptions/Exceptions.php";
require_once __DIR__ . "/AdressenDAO.php";

class KlantDAO
{
    //code by Martijn, Pieter -> getbyKlantId nodig voor alle bedrijfsgegevens/persoonsgegevens in de entiteit bestelling
    public function getByKlantId(int $klantId): ?Klant
    {
        try {
            $sql = "SELECT Gebruikersaccounts.gebruikersAccountId as gebruikersAccountId, emailadres, paswoord, disabled,
                            NatuurlijkePersonen.klantId as klantId, facturatieAdresId, leveringsAdresId,
                            voornaam, familienaam
                    FROM GebruikersAccounts INNER JOIN NatuurlijkePersonen
                    ON GebruikersAccounts.gebruikersAccountId = Natuurlijkepersonen.gebruikersAccountId
                    INNER JOIN Klanten
                    ON Klanten.klantId = Natuurlijkepersonen.KlantId
                    WHERE klanten.klantId = :klantId";
            $dbh = new PDO(
                DBConfig::$DB_CONNSTRING,
                DBConfig::$DB_USERNAME,
                DBConfig::$DB_PASSWORD
            );
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $dbh->prepare($sql);
            $stmt->execute(array(':klantId' => $klantId));
            $rij = $stmt->fetch(PDO::FETCH_ASSOC);
            $dbh = null;

            if ($rij) {
                $adressenDAO = new AdressenDAO;
                $facturatieAdres = $adressenDAO->getAdresById((int) $rij['facturatieAdresId']);
                $leveringsAdres = $adressenDAO->getAdresById((int) $rij['leveringsAdresId']);
                $klant = new Klant(
                    (int) $rij['klantId'],
                    (int) $rij['gebruikersAccountId'],
                    $rij['emailadres'],
                    $rij['paswoord'],
                    $rij['voornaam'],
                    $rij['familienaam'],
                    $leveringsAdres,
                    $facturatieAdres,
                    (bool) $rij['disabled']
                );
            } else {
                $klant = null;
            }
            return $klant;
        } catch (Exception $e) {
            throw new DBConnectionException($e->getMessage());
        }
    }

    public function getByEmailadres(string $emailadres): ?Klant
    {
        try {
            $sql = "SELECT Gebruikersaccounts.gebruikersAccountId as gebruikersAccountId, emailadres, paswoord, disabled,
                            NatuurlijkePersonen.klantId as klantId, facturatieAdresId, leveringsAdresId,
                            voornaam, familienaam
                    FROM GebruikersAccounts INNER JOIN NatuurlijkePersonen
                    ON GebruikersAccounts.gebruikersAccountId = Natuurlijkepersonen.gebruikersAccountId
                    INNER JOIN Klanten
                    ON Klanten.klantId = Natuurlijkepersonen.KlantId
                    WHERE emailadres = :emailadres";
            $dbh = new PDO(
                DBConfig::$DB_CONNSTRING,
                DBConfig::$DB_USERNAME,
                DBConfig::$DB_PASSWORD
            );
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $dbh->prepare($sql);
            $stmt->execute(array(':emailadres' => $emailadres));
            $rij = $stmt->fetch(PDO::FETCH_ASSOC);
            $dbh = null;

            if ($rij) {
                $adressenDAO = new AdressenDAO;
                $facturatieAdres = $adressenDAO->getAdresById((int) $rij['facturatieAdresId']);
                $leveringsAdres = $adressenDAO->getAdresById((int) $rij['leveringsAdresId']);
                $klant = new Klant(
                    (int) $rij['klantId'],
                    (int) $rij['gebruikersAccountId'],
                    $rij['emailadres'],
                    $rij['paswoord'],
                    $rij['voornaam'],
                    $rij['familienaam'],
                    $leveringsAdres,
                    $facturatieAdres,
                    (bool) $rij['disabled']
                );
            } else {
                $klant = null;
            }
            return $klant;
        } catch (Exception $e) {
            throw new DBConnectionException($e->getMessage());
        }
    }


    //maakt een nieuwe rij aan in tabel klanten 
    // en geeft het id van de aangemaakte klant terug
    public function create(int $facturatieAdresId, int $leveringsAdresId): int
    {
        try {
            $sql = "INSERT INTO Klanten (facturatieAdresId, leveringsAdresId) 
                    VALUES (:facturatieAdresId, :leveringsAdresId)";
            $dbh = new PDO(
                DBConfig::$DB_CONNSTRING,
                DBConfig::$DB_USERNAME,
                DBConfig::$DB_PASSWORD
            );
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $dbh->prepare($sql);
            $stmt->execute(array(
                ":facturatieAdresId" => $facturatieAdresId,
                ":leveringsAdresId" => $leveringsAdresId
            ));
            $laatsteNieuweId = (int) $dbh->lastInsertId();
            $dbh = null;

            return $laatsteNieuweId;
        } catch (Exception $e) {
            throw new DBConnectionException($e->getMessage());
        }
    }

    public function update(int $id, int $leveringsAdresId, int $facturatieAdresId): ?Klant {

        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

            $sql = "UPDATE Klanten
            set leveringsAdresId = :leveringsAdresId,
            facturatieAdresId = :facturatieAdresId
            where klantId = :klantId";

            $command = $dbh->prepare($sql);
            $command->execute(array(":klantId" => $id, ":leveringsAdresId" => $leveringsAdresId, ":facturatieAdresId" => $facturatieAdresId));

            $dbh = null;

            return $this->getByKlantId($id);
        } catch (Exception $e) {
            throw new DBConnectionException($e->getMessage());
        }
    }
    
}
