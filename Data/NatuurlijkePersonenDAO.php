<?php

declare(strict_types=1);

require_once __DIR__ . "/DBConfig.php";
require_once __DIR__ . "/../Entities/NatuurlijkePersoon.php";
require_once __DIR__ . "/../Exceptions/Exceptions.php";

class NatuurlijkePersonenDAO
{
    public function create(int $klantId, string $voornaam, string $familienaam, int $gebruikersAccountId)
    {
        try {
            $sql = "INSERT INTO NatuurlijkePersonen (klantId, voornaam, familienaam, gebruikersAccountId) 
                    VALUES (:klantId, :voornaam, :familienaam, :gebruikersAccountId)";
            $dbh = new PDO(
                DBConfig::$DB_CONNSTRING,
                DBConfig::$DB_USERNAME,
                DBConfig::$DB_PASSWORD
            );
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $dbh->prepare($sql);
            $stmt->execute(array(
                ":klantId" => $klantId,
                ":voornaam" => $voornaam,
                ":familienaam" => $familienaam,
                ":gebruikersAccountId" => $gebruikersAccountId
            ));
            
            $dbh = null;

        } catch (Exception $e) {
            throw new DBConnectionException($e->getMessage());
        }
    }

    public function update(int $klantId, string $voornaam, string $familienaam) {

        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

            $sql = "UPDATE NatuurlijkePersonen
            set voornaam = :voornaam,
            familienaam = :familienaam
            where klantId = :klantId";

            $command = $dbh->prepare($sql);
            $command->execute(array(":klantId" => $klantId, ":voornaam" => $voornaam, ":familienaam" => $familienaam));

            $dbh = null;

        } catch (Exception $e) {
            throw new DBConnectionException($e->getMessage());
        }
    }
}