<?php

declare(strict_types=1);

require_once __DIR__ . "/../Entities/Actiecode.php";
require_once __DIR__ . "/DBConfig.php";

class ActiecodesDAO
{
    public function getbyNaam(string $naam): ?Actiecode
    {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "SELECT actiecodeId, naam, geldigVanDatum, geldigTotDatum, isEenmalig
        from actiecodes where naam = :naam";

        $command = $dbh->prepare($sql);
        $command->execute(array(":naam" => $naam));

        $result = $command->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $actiecode = new Actiecode(
                (int) $result["actiecodeId"],
                $result["naam"],
                $result["geldigVanDatum"],
                $result["geldigTotDatum"],
                (bool) $result["isEenmalig"]
            );
        } else {
            $actiecode = null;
        }

        $dbh = null;
        return $actiecode;
    }

    public function deleteByNaam(string $naam) {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "DELETE FROM actiecodes where naam = :naam";

        $command = $dbh->prepare($sql);
        $command->execute(array(":naam" => $naam));

        $dbh = null;
    }
}
