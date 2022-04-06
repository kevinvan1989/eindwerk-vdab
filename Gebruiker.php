<?php

declare(strict_types=1);

require_once __DIR__ . "/Exceptions/Exceptions.php";
require_once __DIR__ . "/Business/ArtikelService.php";
require_once __DIR__ . "/Business/GebruikerService.php";
require_once __DIR__ . "/Business/BestellingService.php";
require_once __DIR__ . "/Business/BestellijnService.php";
require_once __DIR__ . "/Business/PlaatsService.php";
require_once __DIR__ . "/controller-bootstraps/algemeneBootstrap.php";


if (!isset($gebruiker)) {
    header("Location: index.php");
    exit;
}

$invulFoutje = false;
$PWFoutje = false;
$plaatsenService = new PlaatsService;
$plaatsenLijst = $plaatsenService->getPlaatsen();

if (isset($_POST['action'])) {
    $gebruikerService = new GebruikerService;

    if ($_POST['action'] === "Wachtwoord updaten") {
        if (password_verify($_POST['oudPaswoord'], $gebruiker->getPaswoord())) {
            if ($_POST['nieuwPaswoord'] === $_POST['nieuwPaswoordOpnieuw']) {
                $geupdategebruiker = $gebruiker;
                $geupdategebruiker->setPaswoord($_POST['nieuwPaswoord']);
                $gebruiker = $gebruikerService->updatePaswoord($geupdategebruiker);
                $_SESSION['gebruiker']=serialize($gebruiker);
            } else {
                $error = "Gelieve 2x hetzelfde nieuwe wachtwoord in te vullen";
                $invulFoutje = true;
                $PWFoutje = true;
            }
        } else {
            $error = 'Gelieve het juiste Wachtwoord in te vullen bij "oud wachtwoord"';
            $invulFoutje = true;
            $PWFoutje = true;
        }
    }
    if ($_POST['action'] === "Updaten") {
        if ($_POST['facturatiePlaats'] === "" || $_POST['leverPlaats'] === "") {
            $error = "Gelieve een Postcode en Plaats uit de lijst te selecteren";
            $invulFoutje = true;
        } else {
            $plaatsService = new PlaatsService;
            $facturatiePlaats = $plaatsService->getPlaatsById((int) $_POST['facturatiePlaats']);
            $facturatieAdres = new Adres(
                0,
                $_POST['facturatieStraat'],
                $_POST['facturatieHuisnr'],
                $_POST['facturatieBus'],
                $facturatiePlaats,
                true
            );
            $leverPlaats = $plaatsService->getPlaatsById((int) $_POST['leverPlaats']);
            $leverAdres = new Adres(
                0,
                $_POST['leverStraat'],
                $_POST['leverHuisnr'],
                $_POST['leverBus'],
                $leverPlaats,
                true
            );
            if (get_class($gebruiker) === "Rechtspersoon") {
                $geupdategebruiker = new Rechtspersoon(
                    $gebruiker->getKlantId(),
                    $gebruiker->getGebruikersAccountId(),
                    $_POST['emailadres'],
                    $gebruiker->getPaswoord(),
                    $_POST['voornaam'],
                    $_POST['familienaam'],
                    $leverAdres,
                    $facturatieAdres,
                    false,
                    $_POST['bedrijfsnaam'],
                    $_POST['btwNummer'],
                    $_POST['functie'],
                    $gebruiker->getContactpersoonId()
                );
                try {
                    $gebruiker = $gebruikerService->UpdateRechtspersoon($geupdategebruiker);
                    $_SESSION['gebruiker'] = serialize($gebruiker);
                } catch (InvalidEmailadresException $e) {
                    // echo $e->getMessage();
                    $invulFoutje = true;
                    $error = '"'. $_POST['emailadres'] .'" is geen geldig emailadres';
                } catch (EmailadresExistsException $e) {
                    // echo $e->getMessage();
                    $invulFoutje = true;
                    $error = 'Het emailares "'. $_POST['emailadres'] .'" is al in gebruik';
                } catch (DBConnectionException $e) {
                    // echo $e->getMessage();
                    $invulFoutje = true;
                    $error = "Oeps, er ging iets mis";
                }
            } else {
                $geupdategebruiker = new Klant(
                    $gebruiker->getKlantId(),
                    $gebruiker->getGebruikersAccountId(),
                    $_POST['emailadres'],
                    $gebruiker->getPaswoord(),
                    $_POST['voornaam'],
                    $_POST['familienaam'],
                    $leverAdres,
                    $facturatieAdres,
                    false
                );
                try {
                    $gebruiker = $gebruikerService->UpdateKlant($geupdategebruiker);
                    $_SESSION['gebruiker'] = serialize($gebruiker);
                } catch (InvalidEmailadresException $e) {
                    // echo $e->getMessage();
                    $invulFoutje = true;
                    $error = '"'. $_POST['emailadres'] .'" is geen geldig emailadres';
                } catch (EmailadresExistsException $e) {
                    // echo $e->getMessage();
                    $invulFoutje = true;
                    $error = 'Het emailares "'. $_POST['emailadres'] .'" is al in gebruik';
                } catch (DBConnectionException $e) {
                    echo $e->getMessage();
                    $invulFoutje = true;
                    $error = "Oeps, er ging iets mis";
                }
            }
        }
    }
}

if (isset($_GET['view'])) {
    if ($_GET['view'] === 'aanpassen') {
        $pagina = "ProfielgegevensForm";
    }
    if ($_GET['view'] === 'bestellingen') {
        $pagina = "Bestelgeschiedenis";
        $bestelService = new BestellingService();
        $gebruikersId = $gebruiker-> getKlantId(); //dit kan je eventueel ook rechtsreeks in een form doen, zonder aan variabele toe te wijzen
        $alleBestellingen = $bestelService -> getAlleBestellingen($gebruikersId); //idem als hierboven

        $bestellijnService = new BestellijnService();
        $artikelService = new ArtikelService();
    }
} elseif ($invulFoutje) {
    $pagina = "ProfielgegevensForm";
} else {
    $pagina = "ProfielPagina";
}

$bestelService = new BestellingService();


include_once __DIR__ . "/Presentation/GebruikersPagina.php";
