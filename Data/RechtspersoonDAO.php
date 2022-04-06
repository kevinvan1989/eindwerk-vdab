<?php

declare(strict_types=1);

require_once __DIR__ . "/DBConfig.php";
require_once __DIR__ . "/../Entities/Rechtspersoon.php";
require_once __DIR__ . "/../Exceptions/Exceptions.php";
require_once __DIR__ . "/AdressenDAO.php";

class RechtspersoonDAO
{
    //code by Martijn, Pieter -> getbyKlantId nodig voor alle bedrijfsgegevens/persoonsgegevens in de entiteit bestelling
    public function getByKlantId(int $klantId): ?Rechtspersoon
    {
        try {
            $sql = "SELECT GebruikersAccounts.gebruikersAccountId AS gebruikersAccountId, emailadres, paswoord, disabled,
                            Klanten.klantId AS klantId, facturatieAdresId, leveringsAdresId,
                            Contactpersonen.voornaam, Contactpersonen.familienaam, naam, 
                            btwNummer, Rechtspersonen.naam AS bedrijfsnaam, functie, contactpersoonId
                    FROM GebruikersAccounts 
                    INNER JOIN Contactpersonen ON GebruikersAccounts.gebruikersAccountId = Contactpersonen.gebruikersAccountId
                    INNER JOIN Rechtspersonen ON Contactpersonen.klantId = Rechtspersonen.klantId
                    INNER JOIN Klanten ON Klanten.klantId = Rechtspersonen.klantId
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
                $rechtspersoon = new Rechtspersoon(
                    (int) $rij['klantId'],
                    (int) $rij['gebruikersAccountId'],
                    $rij['emailadres'],
                    $rij['paswoord'],
                    $rij['voornaam'],
                    $rij['familienaam'],
                    $leveringsAdres,
                    $facturatieAdres,
                    (bool) $rij['disabled'],
                    $rij['bedrijfsnaam'],
                    $rij['btwNummer'],
                    $rij['functie'],
                    (int) $rij['contactpersoonId']
                );
            } else {
                $rechtspersoon = null;
            }
            return $rechtspersoon;
        } catch (Exception $e) {
            throw new DBConnectionException($e->getMessage());
        }
    }

    public function getByEmailadres(string $emailadres): ?Rechtspersoon
    {
        try {
            $sql = "SELECT GebruikersAccounts.gebruikersAccountId AS gebruikersAccountId, emailadres, paswoord, disabled,
                            Klanten.klantId AS klantId, facturatieAdresId, leveringsAdresId,
                            Contactpersonen.voornaam, Contactpersonen.familienaam, naam, 
                            btwNummer, Rechtspersonen.naam AS bedrijfsnaam, functie, contactpersoonId
                    FROM GebruikersAccounts 
                    INNER JOIN Contactpersonen ON GebruikersAccounts.gebruikersAccountId = Contactpersonen.gebruikersAccountId
                    INNER JOIN Rechtspersonen ON Contactpersonen.klantId = Rechtspersonen.klantId
                    INNER JOIN Klanten ON Klanten.klantId = Rechtspersonen.klantId
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
                $rechtspersoon = new Rechtspersoon(
                    (int) $rij['klantId'],
                    (int) $rij['gebruikersAccountId'],
                    $rij['emailadres'],
                    $rij['paswoord'],
                    $rij['voornaam'],
                    $rij['familienaam'],
                    $leveringsAdres,
                    $facturatieAdres,
                    (bool) $rij['disabled'],
                    $rij['bedrijfsnaam'],
                    $rij['btwNummer'],
                    $rij['functie'],
                    (int) $rij['contactpersoonId']
                );
            } else {
                $rechtspersoon = null;
            }
            return $rechtspersoon;
        } catch (Exception $e) {
            throw new DBConnectionException($e->getMessage());
        }
    }

    public function getByBtwNummer(string $btwNummer): ?Rechtspersoon
    {
        try {
            $sql = "SELECT GebruikersAccounts.gebruikersAccountId AS gebruikersAccountId, emailadres, paswoord, disabled,
                            Klanten.klantId AS klantId, facturatieAdresId, leveringsAdresId,
                            Contactpersonen.voornaam, Contactpersonen.familienaam, naam, 
                            btwNummer, Rechtspersonen.naam AS bedrijfsnaam, functie, contactpersoonId
                    FROM GebruikersAccounts 
                    INNER JOIN Contactpersonen ON GebruikersAccounts.gebruikersAccountId = Contactpersonen.gebruikersAccountId
                    INNER JOIN Rechtspersonen ON Contactpersonen.klantId = Rechtspersonen.klantId
                    INNER JOIN Klanten ON Klanten.klantId = Rechtspersonen.klantId
                    WHERE btwNummer = :btwNummer";
            $dbh = new PDO(
                DBConfig::$DB_CONNSTRING,
                DBConfig::$DB_USERNAME,
                DBConfig::$DB_PASSWORD
            );
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $dbh->prepare($sql);
            $stmt->execute(array(':btwNummer' => $btwNummer));
            $rij = $stmt->fetch(PDO::FETCH_ASSOC);
            $dbh = null;

            if ($rij) {
                $adressenDAO = new AdressenDAO;
                $facturatieAdres = $adressenDAO->getAdresById((int) $rij['facturatieAdresId']);
                $leveringsAdres = $adressenDAO->getAdresById((int) $rij['leveringsAdresId']);
                $rechtspersoon = new Rechtspersoon(
                    (int) $rij['klantId'],
                    (int) $rij['gebruikersAccountId'],
                    $rij['emailadres'],
                    $rij['paswoord'],
                    $rij['voornaam'],
                    $rij['familienaam'],
                    $leveringsAdres,
                    $facturatieAdres,
                    (bool) $rij['disabled'],
                    $rij['bedrijfsnaam'],
                    $rij['btwNummer'],
                    $rij['functie'],
                    (int) $rij['contactpersoonId']
                );
            } else {
                $rechtspersoon = null;
            }
            return $rechtspersoon;
        } catch (Exception $e) {
            throw new DBConnectionException($e->getMessage());
        }
    }


    //als het btwnummer bestaat en de bedrijfsnaam komt overeen geeft deze functie de bestaande klant id terug,
    //als het btw nummer bestaat en de bedrijfsnaam komt niet overeen wordt er een exception gethrowed,
    //als het btw nummer niet bestaat, wordt er eerst een rij in de tabel klanten aangemaakt, 
    //dan een rij in de tabel rechtspersonen, en de nieuwe klant id wordt teruggegeven
    public function create(string $bedrijfsnaam, string $btwNummer, int $facturatieAdresId, int $leveringsAdresId): int
    {
        if ($this->getByBtwNummer($btwNummer)) {
            $rechtspersoon = $this->getByBtwNummer($btwNummer);
            if ($rechtspersoon->getBedrijfsnaam() !== $bedrijfsnaam) {
                throw new BTWNummerExistsException;
            } else {
                return $rechtspersoon->getKlantId();
            }
        }

        $klantDAO = new KlantDAO;
        $klantId = $klantDAO->create($facturatieAdresId, $leveringsAdresId);

        try {
            $sql = "INSERT INTO Rechtspersonen (klantId, naam, btwNummer) 
                    VALUES (:klantId, :naam, :btwNummer)";
            $dbh = new PDO(
                DBConfig::$DB_CONNSTRING,
                DBConfig::$DB_USERNAME,
                DBConfig::$DB_PASSWORD
            );
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $dbh->prepare($sql);
            $stmt->execute(array(
                ":klantId" => $klantId,
                ":naam" => $bedrijfsnaam,
                ":btwNummer" => $btwNummer
            ));
            $dbh = null;
            return $klantId;
        } catch (Exception $e) {
            throw new DBConnectionException($e->getMessage());
        }
    }

    public function update(int $klantId, string $bedrijfsnaam, string $btwNummer): ?Rechtspersoon
    {

        if ($this->getByBtwNummer($btwNummer) && $this->getByBtwNummer($btwNummer)->getKlantId() !== $klantId) {
            throw new BTWNummerExistsException;
        }

        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

            $sql = "UPDATE Rechtspersonen
            set naam = :bedrijfsnaam,
            btwNummer = :btwNummer
            where klantId = :klantId";

            $command = $dbh->prepare($sql);
            $command->execute(array(":klantId" => $klantId, ":bedrijfsnaam" => $bedrijfsnaam, ":btwNummer" => $btwNummer));

            $dbh = null;

            return $this->getByKlantId($klantId);
        } catch (Exception $e) {
            throw new DBConnectionException($e->getMessage());
        }
    }
}
