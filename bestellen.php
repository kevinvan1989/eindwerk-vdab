<?php

declare(strict_types=1);

require_once __DIR__ . "/Business/ActiecodeService.php";
require_once __DIR__ . "/Business/BestellingService.php";
require_once __DIR__ . "/Business/GebruikerService.php";
require_once __DIR__ . "/Exceptions/Exceptions.php";
require_once __DIR__ . "/controller-bootstraps/algemeneBootstrap.php";

if (isset($gebruiker) && count($winkelmandje->inhoud) !== 0) {
    if(isset($_SESSION["korting"])) {
        $korting = $_SESSION["korting"];
    } else {
        $korting = false;
    }
    $betaald = false;
    
    if (isset($_POST["actiecodeToevoegen"])) {
        try {
            $actiecodeService = new ActiecodeService();
            $actiecode = $actiecodeService->getByNaam($_POST["actiecodeVeld"]);
    
            if ($actiecode !== null) {
                $actiecodeService->deleteByNaam($_POST["actiecodeVeld"]);
                $korting = true;
                $_SESSION["korting"] = $korting;
        }
        } catch (OngeldigeActiecodeException $e) {
            $error = 'Deze actiecode is niet geldig.';
        }
    }


    if (isset($_POST["bestel"])) {
        $bestellingService = new BestellingService();

        $bestellijnen = [];
        for ($i = 0; $i < count($winkelmandje->inhoud); $i++) {
            $artikelArray = [];
            $artikelArray["artikelId"] = $winkelmandje->inhoud[$i]['artikel']->getId();
            $artikelArray["aantalBesteld"] = $winkelmandje->inhoud[$i]['aantal'];
            $artikelArray["aantalGeannuleerd"] = 0;

            array_push($bestellijnen, $artikelArray);
        }

        if($_POST["betaalwijzeId"] == 1) {
            $betaald = true;
        }

        $bestellingService->createBestelling((int) $_POST["betaalwijzeId"], $korting, $betaald, (int) $_POST["betaalwijzeId"], $bestellijnen);
        unset($_SESSION["korting"]);
        unset($_SESSION["winkelmandje"]);
        $winkelmandje->inhoud = [];
        header("Location: Gebruiker.php?view=bestellingen");
    }
} else {
    header("Location: index.php");
}

include_once __DIR__ . "/Presentation/Bestelpagina.php";
