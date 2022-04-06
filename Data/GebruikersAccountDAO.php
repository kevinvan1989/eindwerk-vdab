<?php

declare(strict_types=1);

require_once __DIR__ . "/DBConfig.php";
require_once __DIR__ . "/../Entities/GebruikersAccount.php";
require_once __DIR__ . "/../Exceptions/Exceptions.php";

class GebruikersAccountDAO
{
    public function getById(int $gebruikersAccountId): ?GebruikersAccount
    {

        try {
            $sql = "SELECT gebruikersAccountId, emailadres, paswoord, disabled 
                    from GebruikersAccounts 
                    where gebruikersAccountId = :gebruikersAccountId";
            $dbh = new PDO(
                DBConfig::$DB_CONNSTRING,
                DBConfig::$DB_USERNAME,
                DBConfig::$DB_PASSWORD
            );
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $dbh->prepare($sql);
            $stmt->execute(array(':gebruikersAccountId' => $gebruikersAccountId));
            $rij = $stmt->fetch(PDO::FETCH_ASSOC);
            $dbh = null;

            if ($rij) {
                $gebruikersAccount = new GebruikersAccount(
                    (int) $gebruikersAccountId,
                    $rij['emailadres'],
                    $rij['paswoord'],
                    (bool) $rij['disabled']
                );
            } else {
                $gebruikersAccount = null;
            }
            return $gebruikersAccount;
        } catch (Exception $e) {
            throw new DBConnectionException($e->getMessage());
        }
    }

    public function getByEmailadres(string $emailadres): ?GebruikersAccount
    {

        try {
            $sql = "SELECT gebruikersAccountId, emailadres, paswoord, disabled 
                    FROM GebruikersAccounts 
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
                $gebruikersAccount = new GebruikersAccount(
                    (int) $rij['gebruikersAccountId'],
                    $emailadres,
                    $rij['paswoord'],
                    (bool) $rij['disabled']
                );
            } else {
                $gebruikersAccount = null;
            }
            return $gebruikersAccount;
        } catch (Exception $e) {
            throw new DBConnectionException($e->getMessage());
        }
    }

    public function create(string $emailadres, string $paswoord): GebruikersAccount
    {

        if ($this->getByEmailadres($emailadres)) {
            throw new EmailadresExistsException();
        }

        if (!filter_var($emailadres, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailadresException();
        }

        $paswoord = password_hash($paswoord, PASSWORD_DEFAULT);

        try {
            $sql = "INSERT INTO GebruikersAccounts (emailadres, paswoord) 
                    VALUES (:emailadres, :paswoord)";
            $dbh = new PDO(
                DBConfig::$DB_CONNSTRING,
                DBConfig::$DB_USERNAME,
                DBConfig::$DB_PASSWORD
            );
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $dbh->prepare($sql);
            $stmt->execute(array(
                ":emailadres" => $emailadres,
                ":paswoord" => $paswoord
            ));
            $laatsteNieuweId = $dbh->lastInsertId();
            $dbh = null;

            $gebruikersAccount = new GebruikersAccount((int)$laatsteNieuweId, $emailadres, $paswoord, false);

            return $gebruikersAccount;
        } catch (Exception $e) {
            throw new DBConnectionException($e->getMessage());
        }
    }

    public function updateEmail(int $id, string $emailadres): ?GebruikersAccount {

        if ($this->getByEmailadres($emailadres) && $this->getByEmailadres($emailadres)->getGebruikersAccountId() !== $id ) {
            throw new EmailadresExistsException();
        }

        if (!filter_var($emailadres, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailadresException();
        }

        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

            $sql = "UPDATE GebruikersAccounts
            set emailadres = :emailadres
            where gebruikersAccountId = :id";

            $command = $dbh->prepare($sql);
            $command->execute(array(":id" => $id, ":emailadres" => $emailadres));

            $dbh = null;

            $gebruikersAccount = $this->getById($id);
            return $gebruikersAccount;
        } catch (Exception $e) {
            throw new DBConnectionException($e->getMessage());
        }
    }

    public function updatePaswoord(int $id, string $paswoord): ?GebruikersAccount {

        $paswoord = password_hash($paswoord, PASSWORD_DEFAULT);

        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

            $sql = "UPDATE GebruikersAccounts
            set paswoord = :paswoord
            where gebruikersAccountId = :id";

            $command = $dbh->prepare($sql);
            $command->execute(array(":id" => $id, ":paswoord" => $paswoord));

            $dbh = null;

            $gebruikersAccount = $this->getById($id);
            return $gebruikersAccount;
        } catch (Exception $e) {
            throw new DBConnectionException($e->getMessage());
        }
    }

}
