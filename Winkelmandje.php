<?php

declare(strict_types=1);

require_once __DIR__ . "/controller-bootstraps/algemeneBootstrap.php";

if (isset($_GET['action'])) {
    if ($_GET['action'] === "verwijder") {
        $mandje = unserialize($_SESSION['winkelmandje']);
        array_splice($mandje->inhoud, (int) $_GET['index'], 1);
        $_SESSION['winkelmandje'] = serialize($mandje);
        $winkelmandje = $mandje;
        $totaal = 0;
        foreach ($winkelmandje->inhoud as $key => $value) {
            $totaal += $value['artikel']->getPrijs() * $value['aantal'];
        }
        $totaal = number_format($totaal, 2, ",", ".");
    }

    if ($_GET['action'] === 'wijzig') {
        $mandje = unserialize($_SESSION['winkelmandje']);
        foreach ($_POST['aantal'] as $key => $value) {
            if ($value > 0) {
                $mandje->inhoud[(int) $key]['aantal'] = (int) $value;
            }
        }
        $_SESSION['winkelmandje'] = serialize($mandje);
        $winkelmandje = $mandje;
        $totaal = 0;
        foreach ($winkelmandje->inhoud as $key => $value) {
            $totaal += $value['artikel']->getPrijs() * $value['aantal'];
        }
        $totaal = number_format($totaal, 2, ",", ".");
    }

    if ($_GET['action'] === 'Weggooien') {
        $winkelmandje->inhoud = [];
        $totaal = "0,00";
        $_SESSION['winkelmandje'] = serialize($winkelmandje);
    }
}

include_once __DIR__ . "/Presentation/WinkelmandjeWeergave.php";
