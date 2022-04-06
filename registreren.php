<?php

declare(strict_types=1);

require_once __DIR__ . "/Exceptions/Exceptions.php";
require_once __DIR__ . "/Business/PlaatsService.php";
require_once __DIR__ . "/controller-bootstraps/algemeneBootstrap.php";

$plaatsService = new PlaatsService();
$plaatsenLijst = $plaatsService->getPlaatsen();

if (isset($_POST["action"]) && $_POST["action"] === "Registreren") {
    $emailadres = $_POST['emailadres'];
    if ($_POST['paswoord'] === $_POST['paswoordOpnieuw']) {
        $paswoord = $_POST['paswoord'];
    } else {
        $error = "Gelieve 2x hetzelfde Wachtwoord in te geven";
    }
    $facturatieStraat = $_POST['facturatieStraat'];
    $facturatieHuisnr = $_POST['facturatieHuisnr'];
    $facturatieBus = $_POST['facturatieBus'];
    if (isset($_POST['facturatiePlaats']) && $_POST['facturatiePlaats'] !== "") {
        $facturatiePlaatsId = (int) $_POST['facturatiePlaats']; // <-- hier komt de value in van de plaats select
        $facturatiePlaats = $plaatsService->getPlaatsById($facturatiePlaatsId);
        $facturatiePlaats = $facturatiePlaats->getPostcode() . " " . $facturatiePlaats->getPlaats();
    } else {
        $error = "Gelieve een voorgestelde plaats te selecteren";
    }

    if (isset($_POST["apartLeverAdres"]) && !isset($error)) {
        $leverStraat = $_POST['leverStraat'];
        $leverHuisnr = $_POST['leverHuisnr'];
        $leverBus = $_POST['leverBus'];
        if (isset($_POST['leverPlaats']) && $_POST['leverPlaats'] !== "") {
            $leverPlaatsId = (int) $_POST['leverPlaats']; // <-- hier komt de value in van de plaats select
            $leverPlaats = $plaatsService->getPlaatsById($leverPlaatsId);
            $leverPlaats = $leverPlaats->getPostcode() . " " . $leverPlaats->getPlaats();
        } else {
            $error = "Gelieve een voorgestelde plaats te selecteren";
        }
    } elseif (!isset($error)) {
        $leverStraat = $facturatieStraat;
        $leverHuisnr = $facturatieHuisnr;
        $leverBus = $facturatieBus;
        $leverPlaatsId = $facturatiePlaatsId;
    }
    $voornaam = $_POST['voornaam'];
    $familienaam = $_POST['familienaam'];

    try {
        if (!isset($error)) {
            $facturatiePlaats = $plaatsService->getPlaatsById($facturatiePlaatsId)->getPostcode();
            $facturatiePlaats .= " ";
            $facturatiePlaats .= $plaatsService->getPlaatsById($facturatiePlaatsId)->getPlaats();
            $leverPlaats = $plaatsService->getPlaatsById($leverPlaatsId)->getPostcode();
            $leverPlaats .= " ";
            $leverPlaats .= $plaatsService->getPlaatsById($leverPlaatsId)->getPlaats();
            if (isset($_POST["rechtspersoon"])) {
                $bedrijfsnaam = $_POST["bedrijfsnaam"];
                $btwNummer = $_POST["btwNummer"];
                $functie = $_POST["functie"];
                $gebruiker = $gebruikerService->registerContactPersoon(
                    $emailadres,
                    $paswoord,
                    $bedrijfsnaam,
                    $btwNummer,
                    $leverStraat,
                    $leverHuisnr,
                    $leverBus,
                    $leverPlaatsId,
                    true,
                    $facturatieStraat,
                    $facturatieHuisnr,
                    $facturatieBus,
                    $facturatiePlaatsId,
                    true,
                    $voornaam,
                    $familienaam,
                    $functie
                );
            } else {
                $gebruiker = $gebruikerService->registerNatuurlijkePersoon(
                    $emailadres,
                    $paswoord,
                    $leverStraat,
                    $leverHuisnr,
                    $leverBus,
                    $leverPlaatsId,
                    true,
                    $facturatieStraat,
                    $facturatieHuisnr,
                    $facturatieBus,
                    $facturatiePlaatsId,
                    true,
                    $voornaam,
                    $familienaam
                );
            }

            $gebruiker = $gebruikerService->login($emailadres, $paswoord);      //try...catch DBConnectionException
            $_SESSION['gebruiker'] = serialize($gebruiker);
        }
    } catch (DBConnectionException $e) {
        $error = "Oeps, er ging iets mis";
    } catch (EmailadresExistsException $e) {
        $error = "Dit emailadres is reeds in gebruik.";
    } catch (InvalidEmailadresException $e) {
        $error = "Dit is geen geldig emailadres.";
    }
}

if (isset($_SESSION['gebruiker'])) {
    // print("<h1>INGELOGDE GEBRUIKER (session gebruiker)</h1>");
    header("Location: index.php");
    exit;
}

include_once __DIR__ . "/Presentation/Registreer.php";
