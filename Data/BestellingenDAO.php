<?php

declare (strict_types = 1);

require_once __DIR__ . "/BestellijnenDAO.php";
require_once __DIR__ . "/DBConfig.php";
require_once __DIR__ . "/../Entities/Bestelling.php";
require_once __DIR__ . "/../Entities/Klant.php";
require_once __DIR__ . "/../Entities/Rechtspersoon.php";

require_once __DIR__ . "/../Business/GebruikerService.php";

class BestellingenDAO {
    public function getByKlantId(int $klantId) {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $sql = "SELECT bestelId, besteldatum, klantId, betaald, betalingsCode, betaalwijzeId, annulatie, annulatiedatum,
        terugbetalingscode, bestellingsStatusId, actiecodeGebruikt, bedrijfsnaam, btwNummer, voornaam, familienaam, 
        facturatieAdresId, leveringsAdresId from bestellingen 
        WHERE klantId = :klantId
        ORDER BY besteldatum desc, bestelId desc";

        $command = $dbh->prepare($sql);
        $command->execute(array(":klantId" => $klantId));

        $resultSet = $command->fetchAll(PDO::FETCH_ASSOC);

        if($resultSet !== null) {
            $lijst = [];

            $bestellijnenDAO = new BestellijnenDAO();

            foreach($resultSet as $result) {
                $bestellijnen = $bestellijnenDAO->getBestellijnenByBestelId((int) $result["bestelId"]);

                $bestelling = new Bestelling((int) $result["bestelId"], $result["besteldatum"],(int)  $result["klantId"], $result["voornaam"],
                $result["familienaam"], $result["bedrijfsnaam"], $result["btwNummer"],(bool) $result["betaald"], $result["betalingsCode"],
                (int) $result["betaalwijzeId"],(int) $result["bestellingsStatusId"],(bool) $result["actiecodeGebruikt"],(array) $bestellijnen,(bool) $result["annulatie"], 
                $result["annulatiedatum"], $result["terugbetalingscode"]);

                array_push($lijst, $bestelling);
            }
        } else {
            $lijst = null;
        }
        return $lijst;
    }

    public function createBestelling(int $betaalwijzeId, bool $actiecodeGebruikt = false, bool $betaald = false, 
    int $bestellingsStatusId = 1, bool $annulatie = false) : int { //geeft lastinsertid terug -> gebruiken voor aanmaak bestellijnen
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "INSERT INTO bestellingen (besteldatum, klantId, betaald, 
        betaalwijzeId, annulatie, bestellingsStatusId, actiecodeGebruikt,
        bedrijfsnaam, btwNummer, voornaam, familienaam, facturatieAdresId, leveringsAdresId)
        values(current_date(), :klantId, :betaald, 
        :betaalwijzeId, :annulatie, :bestellingsStatusId, :actiecodeGebruikt,
        :bedrijfsnaam, :btwNummer, :voornaam, :familienaam, :facturatieAdresId, :leveringsAdresId)";

        $command = $dbh->prepare($sql);
        
        
        if (isset($_SESSION['gebruiker'])) {
            $gebruiker = unserialize($_SESSION['gebruiker'], ["Klant", "Rechtspersoon"]);
        }
        
        
        /* VOOR DE TEST - HARDCODED GEBRUIKER
        $gebruikerService = new GebruikerService();
        $gebruiker = $gebruikerService->login("vdb_martijn@hotmail.com", "aap");
        $_SESSION['gebruiker'] = serialize($gebruiker);
        */

        if(method_exists($gebruiker,'getBedrijfsnaam')) {
            $bedrijfsNaam = $gebruiker->getBedrijfsnaam();
            $btwNr = $gebruiker->getbtwNr();
        } else {
            $bedrijfsNaam = null;
            $btwNr = null;
        }

        $command->execute(array(":klantId" => $gebruiker->getKlantId(), ":betaald" => $betaald, 
        ":betaalwijzeId" => $betaalwijzeId, ":annulatie" => $annulatie,
        ":bestellingsStatusId" => $bestellingsStatusId, ":actiecodeGebruikt" => $actiecodeGebruikt,
        ":bedrijfsnaam" => $bedrijfsNaam, ":btwNummer" => $btwNr, ":voornaam" => $gebruiker->getVoornaam(),
        ":familienaam" => $gebruiker->getFamilienaam(), ":facturatieAdresId" => $gebruiker->getFacturatieAdres()->getAdresId(), 
        ":leveringsAdresId" => $gebruiker->getLeveringsAdres()->getAdresId()));

        $_SESSION['gebruiker'] = serialize($gebruiker);

        $bestelId = (int) $dbh->lastInsertId();
        $dbh = null;

        return $bestelId;
    }

    public function getBestelstatusById(int $bestelStatusId) {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $sql = "SELECT naam from bestellingsstatussen WHERE bestellingsStatusId = :bestelStatusId";

        $command = $dbh->prepare($sql);
        $params = array(':bestelStatusId' => $bestelStatusId);
        $command->execute($params);

        $result = $command->fetch(PDO::FETCH_ASSOC);

        $status = $result["naam"];

        $dbh = null;

        return $status;
    }
}




// $query = "SELECT 'id' FROM Users WHERE username = :name LIMIT 1";
// $statement = $PDO->prepare($query);
// $params = array(
//     'name' => $_GET["username"]
// );
// $statement->execute($params);
// $user_data = $statement->fetch();

