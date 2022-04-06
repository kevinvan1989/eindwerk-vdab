<?php
declare (strict_types = 1);

require_once __DIR__ . "/../Entities/Plaats.php";
require_once __DIR__ . "/../Data/DBConfig.php";

class PlaatsenDAO {
    public function getAll() : Array {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $sql = "SELECT plaatsId, postcode, plaats from plaatsen order by postcode, plaats"; //in de select (presentatie) -> option naam = plaats, postcode en value = plaatsId

        $command = $dbh->query($sql);
        $resultSet = $command->fetchAll(PDO::FETCH_ASSOC);

        $lijst = [];

        foreach($resultSet as $result) {
            $plaats = new Plaats((int) $result["plaatsId"], $result["postcode"], $result["plaats"]);
            array_push($lijst, $plaats);
        }

        $dbh = null;

        return $lijst;
    }

    public function getById(int $plaatsId) : Plaats {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $sql = "SELECT plaatsId, postcode, plaats from plaatsen WHERE plaatsId = :plaatsId"; //in de select (presentatie) -> option naam = plaats, postcode en value = plaatsId

        $command = $dbh->prepare($sql);
        $command->execute(array(":plaatsId" => $plaatsId));

        $result = $command->fetch(PDO::FETCH_ASSOC);
        $plaats = new Plaats((int) $result["plaatsId"], $result["postcode"], $result["plaats"]);

        $dbh = null;

        return $plaats;
    }
}