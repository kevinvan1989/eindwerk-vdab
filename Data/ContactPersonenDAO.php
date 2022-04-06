<?php

declare(strict_types=1);

require_once __DIR__ . "/DBConfig.php";
require_once __DIR__ . "/../Entities/Contactpersonen.php";
require_once __DIR__ . "/../Exceptions/Exceptions.php";

class ContactpersonenDAO
{
    public function getContactpersonenByEmailadres(string $emailadres): ?array
    {
        $sql = "SELECT contactpersoonId, voornaam, familienaam, functie,
                       klantId, Contactpersonen.gebruikersAccountId
                FROM Contactpersonen INNER JOIN GebruikersAccounts
                ON GebruikersAccounts.gebruikersAccountId = Contactpersonen.gebruikersAccountId
                WHERE emailadres = :emailadres";
        try {        
            $dbh = new PDO(
                DBConfig::$DB_CONNSTRING,
                DBConfig::$DB_USERNAME,
                DBConfig::$DB_PASSWORD
            );
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $dbh->prepare($sql);
            $stmt->execute(array(':emailadres' => $emailadres));
            $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $contactpersonen = [];

            if ($resultSet) {
                foreach ($resultSet as $rij) {
                $contactpersonen = new Contactpersonen(
                    (int) $rij['contactpersoonId'],              
                    $rij['voornaam'],
                    $rij['familienaam'],
                    $rij['functie'],
                    (int) $rij['klantId'],
                    (int) $rij['gebruikersAccountId']
                    );
                }
            } else {
                $contactpersonen = null;
            }
            $dbh = null;
            return $contactpersonen;
        } catch (Exception $e) {
            throw new DBConnectionException($e->getMessage());
        }
    }

    public function create(string $voornaam, string $familienaam, string $functie, int $klantId, int $gebruikersAccountId)
    {
        
        try {
            $sql = "INSERT INTO Contactpersonen (voornaam, familienaam, functie, klantId, gebruikersAccountId) 
                    VALUES (:voornaam, :familienaam, :functie, :klantId, :gebruikersAccountId)";
            $dbh = new PDO(
                DBConfig::$DB_CONNSTRING,
                DBConfig::$DB_USERNAME,
                DBConfig::$DB_PASSWORD
            );
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $dbh->prepare($sql);
            $stmt->execute(array(
                ":voornaam" => $voornaam,
                ":familienaam" => $familienaam,
                ":functie" => $functie,
                ":klantId" => $klantId,
                ":gebruikersAccountId" => $gebruikersAccountId
            ));
            $laatsteNieuweId = (int) $dbh->lastInsertId();
            $dbh = null;
            return $laatsteNieuweId;
        } catch (Exception $e) {
            throw new DBConnectionException($e->getMessage());
        }
    }

    public function update(int $contactpersoonId, string $voornaam, string $familienaam, string $functie)
    {

        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

            $sql = "UPDATE Contactpersonen
            set voornaam = :voornaam,
            familienaam = :familienaam,
            functie = :functie
            where contactpersoonId = :contactpersoonId";

            $command = $dbh->prepare($sql);
            $command->execute(array(
                ":contactpersoonId" => $contactpersoonId, 
                ":voornaam" => $voornaam, 
                ":familienaam" => $familienaam, 
                ":functie" => $functie
            ));

            $dbh = null;
        } catch (Exception $e) {
            throw new DBConnectionException($e->getMessage());
        }
    }
}