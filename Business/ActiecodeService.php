<?php

declare(strict_types = 1);

require_once __DIR__ . "/../Data/ActiecodesDAO.php";
require_once __DIR__ . "/../Exceptions/Exceptions.php";

class ActiecodeService {
    public function getByNaam(string $naam) : Actiecode {
        $actiecodesDAO = new ActiecodesDAO();
        $actiecode = $actiecodesDAO->getbyNaam($naam);
        if($actiecode !== null) {
            $geldigVanDatum = $actiecode->getGeldigVanDatum();
            $geldigTotDatum = $actiecode->getGeldigTotDatum();
            $dateTime = new DateTime("now");
            $huidigeDatum = $dateTime->format('Y-m-d');

            if ($huidigeDatum <= $geldigTotDatum && $huidigeDatum >= $geldigVanDatum) {
                return $actiecode;
            } else {
                throw new OngeldigeActiecodeException();
            }
        } else {
            throw new OngeldigeActiecodeException();
        }
    }
    public function deleteByNaam(string $naam) {
        $actiecodesDAO = new ActiecodesDAO();
        $actiecode = $actiecodesDAO->getbyNaam($naam);
        if($actiecode->getIsEenmalig()) {
            $actiecodesDAO->deleteByNaam($naam);
        }
    }
}