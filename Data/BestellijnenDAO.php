<?php
declare(strict_types = 1);

require_once __DIR__ . "/../Entities/Bestellijn.php";
require_once __DIR__ . "/DBConfig.php";


class BestellijnenDAO {
    public function getBestellijnenByBestelId(int $bestelId) : array {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "SELECT bestellijnId, bestelId, artikelId, aantalBesteld, aantalGeannuleerd
        from bestellijnen where bestelId = :bestelId";

        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  

        $command = $dbh->prepare($sql);
        $command->execute(array(":bestelId" => $bestelId));

        $resultSet = $command->fetchAll(PDO::FETCH_ASSOC);

        $lijst = [];

        foreach($resultSet as $result) {
            $bestellijn = new Bestellijn((int) $result["bestellijnId"],(int) $result["bestelId"],(int) $result["artikelId"],
            (int) $result["aantalBesteld"],(int) $result["aantalGeannuleerd"]);
    
            array_push($lijst, $bestellijn);
    }

    $dbh = null;

    return $lijst;
}

    public function createBestellijn(int $bestelId, int $artikelId, int $aantalBesteld, int $aantalGeannuleerd) {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

            $sql = "INSERT INTO bestellijnen (bestelId, artikelId, aantalBesteld, aantalGeannuleerd)
            values (:bestelId, :artikelId, :aantalBesteld, :aantalGeannuleerd)";
            
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  

            $command = $dbh->prepare($sql);
            $command->execute(array(":bestelId" => $bestelId, ":artikelId" => $artikelId, 
            ":aantalBesteld" => $aantalBesteld, ":aantalGeannuleerd" => $aantalGeannuleerd));
            
            $dbh = null;
        }
}