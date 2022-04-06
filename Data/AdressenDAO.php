<?php

declare(strict_types=1);

require_once __DIR__ . "/../Entities/Adres.php";
require_once __DIR__ . "/../Entities/Plaats.php";
require_once __DIR__ . "/../Data/DBConfig.php";
require_once __DIR__ . "/../Data/PlaatsenDAO.php";
require_once __DIR__ . "/../Exceptions/Exceptions.php";

class AdressenDAO
{
    public function createAdres(
        string $straat,
        string $huisnr,
        string $bus,
        int $plaatsId,
        bool $actief = true
    ) : Adres {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $sql = "INSERT INTO adressen (straat, huisNummer, bus, plaatsId, actief) 
        values(:straat, :huisNummer, :bus, :plaatsId, :actief)";

        if ($actief) {
            $actief === 1;
        } else {
            $actief === 0;
        }

        $command = $dbh->prepare($sql);
        $command->execute(array(
            ":straat" => $straat, ":huisNummer" => $huisnr,
            ":bus" => $bus, ":plaatsId" => $plaatsId, ":actief" => $actief
        ));
        $adresId = $dbh->lastInsertId();

        $dbh = null;

        $plaatsenDAO = new PlaatsenDAO();
        $plaats = $plaatsenDAO->getById($plaatsId);

        $adres = new Adres((int) $adresId, $straat, $huisnr, $bus, $plaats, $actief);

        return $adres;
    }

    public function getAdresById(int $adresId): Adres
    { 
        try {
            $sql = "SELECT straat, huisNummer, bus, plaatsId, actief 
                    from Adressen 
                    where adresId = :adresId";
            $dbh = new PDO(
                DBConfig::$DB_CONNSTRING,
                DBConfig::$DB_USERNAME,
                DBConfig::$DB_PASSWORD
            );
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $dbh->prepare($sql);
            $stmt->execute(array(':adresId' => $adresId));
            $rij = $stmt->fetch(PDO::FETCH_ASSOC);
            $dbh = null;

            if ($rij) {
                $plaatsenDAO = new PlaatsenDAO;
                $plaats = $plaatsenDAO->getById((int) $rij['plaatsId']);
                $gebruikersAccount = new Adres(
                    $adresId,
                    $rij['straat'],
                    $rij['huisNummer'],
                    $rij['bus'],
                    $plaats,
                    (bool) $rij['actief']
                );
            } else {
                $gebruikersAccount = null;
            }
            return $gebruikersAccount;
        } catch (Exception $e) {
            throw new DBConnectionException($e->getMessage());
        }
    }

    public function disableAdres(int $adresId) {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

            $sql = "UPDATE adressen
            set actief = 0
            where adresId = :adresId";

            $command = $dbh->prepare($sql);
            $command->execute(array(":adresId" => $adresId));

            $dbh = null;
        } catch (Exception $e) {
            throw new DBConnectionException($e->getMessage());
        }
    }

    public function updateLeverAdres(int $klantId, int $leveringsAdresId) {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

            $sql = "UPDATE klanten
            set leveringsAdresId = :leveringsAdresId
            where klantId = :klantId";

            $command = $dbh->prepare($sql);
            $command->execute(array(":klantId" => $klantId, ":leveringsAdresId" => $leveringsAdresId));

            $dbh = null;
        } catch (Exception $e) {
            throw new DBConnectionException($e->getMessage());
        }
    }
    
    public function updateFacturatieAdres(int $klantId, int $facturatieAdresId) {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

            $sql = "UPDATE klanten
            set facturatieAdresId = :facturatieAdresId
            where klantId = :klantId";

            $command = $dbh->prepare($sql);
            $command->execute(array(":klantId" => $klantId, ":facturatieAdresId" => $facturatieAdresId));

            $dbh = null;
        } catch (Exception $e) {
            throw new DBConnectionException($e->getMessage());
        }
    }
}
