<?php
declare(strict_types = 1);

require_once __DIR__ . "/../Data/BestellijnenDAO.php";

class BestellijnService{
    public function getBestellijnen(int $bestelId) : array {
        $bestellijnenDAO = new BestellijnenDAO();
        $lijst = $bestellijnenDAO->getBestellijnenByBestelId($bestelId);

        return $lijst;
    }
}