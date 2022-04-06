<?php

declare(strict_types = 1);

require_once __DIR__ . "/../Data/BestellingenDAO.php";
require_once __DIR__ . "/../Data/BestellijnenDAO.php";

class BestellingService {
    public function createBestelling(int $betaalwijzeId, bool $actiecodeGebruikt = false, bool $betaald = false, int $bestellingsStatusId = 1, array $bestellijnen) {
        $bestellingenDAO = new BestellingenDAO();
        $bestelId = $bestellingenDAO->createBestelling((int) $betaalwijzeId, $actiecodeGebruikt, $betaald, $bestellingsStatusId);
        
        $bestellijnenDAO = new BestellijnenDAO();
        foreach($bestellijnen as $bestellijn) {
            $bestellijnenDAO->createBestellijn((int) $bestelId, (int) $bestellijn["artikelId"], (int) $bestellijn["aantalBesteld"], (int) $bestellijn["aantalGeannuleerd"]);
        }
    }
    
    public function getAlleBestellingen(int $klantId) {
        $bestellingenDAO = new BestellingenDAO();
        $lijst = $bestellingenDAO->getByKlantId($klantId);
        
        return $lijst;
    }
    
    public function getStatusById(int $bestelstatusId) {
        $bestellingenDAO = new BestellingenDAO();
        $status = $bestellingenDAO->getBestelstatusById($bestelstatusId);
        return $status;
    }
}