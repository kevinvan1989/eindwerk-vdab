<?php

declare(strict_types=1);

session_start();

require_once __DIR__ . "/../Business/GebruikerService.php";
require_once __DIR__ . "/../Exceptions/Exceptions.php";
require_once __DIR__ . "/../Business/ArtikelService.php";

$gebruikerService = new GebruikerService;

$url = htmlspecialchars("http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
if (preg_match('/(logout)/', $url) === 1) {
    $url = explode("?", $url)[0];
} elseif (substr($url, -1) === "?" || substr($url, -1) === "&") {
    $url = substr($url, 0, strlen($url) - 1);
}
$url .= ((preg_match('/(\?)/', $url) === 1) ? "&" : "?");

if (isset($_SESSION['gebruiker'])) {
    $gebruiker = unserialize($_SESSION['gebruiker'], ["Klant", "Rechtspersoon"]);
}

if (isset($_POST['action'])) {
    if ($_POST['action'] === 'Login') {
        $emailadres = $_POST['emailadres'];
        $paswoord = $_POST['paswoord'];
        try {
            $gebruiker = $gebruikerService->login($emailadres, $paswoord);
            $_SESSION['gebruiker'] = serialize($gebruiker);
        } catch (InvalidPasswordException $e) {
            $error = "Wachtwoord en emailadres komen niet overeen";
        } catch (NonExistingUserException $e) {
            $error = "Wachtwoord en emailadres komen niet overeen";
        } catch (DisabledUserException $e) {
            $error = "Uw account is geblokkeerd, gelieve contact op te nemen met onze klantendienst";
        } catch (DBConnectionException $e) {
            $error = "Oeps, er ging iets mis";
        }
    }
    if ($_POST['action'] === 'Logout') {
        unset($_SESSION['gebruiker']);
        $gebruiker = null;
    }
}
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    if (isset($_SESSION['gebruiker'])) {
        unset($_SESSION['gebruiker']);
        $gebruiker = null;
    }
}

//gebruik $_SESSION['winkelmandje']:
//artikel toevoegen:
//1. $mandje = unserialize($_SESSION['winkelmandje'], ['stdClass', 'Artikel'])
//2. $mandje->inhoud[]= ['artikel' => $artikel, 'aantal' => $aantal];  waarbij $artikel een artikelobject is an $aantal een int.
//3. $_SESSION['winkelmandje'] = serialize($mandje);

$winkelmandje = new stdClass;
$winkelmandje->inhoud = [];
$totaal = 0;

if (isset($_SESSION['winkelmandje'])) {
    $winkelmandje = unserialize($_SESSION['winkelmandje'], ['stdClass', 'Artikel']);
    for ($i = 0; $i < count($winkelmandje->inhoud); $i++) {

        $totaal += $winkelmandje->inhoud[$i]['artikel']->getPrijs() * $winkelmandje->inhoud[$i]['aantal'];
    }
    $totaal = number_format($totaal, 2, ",", ".");
} else {
    $_SESSION['winkelmandje'] = serialize($winkelmandje);
}

if (!isset($_COOKIE['user'])) {
    setcookie('user', 'empty', time() + (60 * 60 * 24 * 7));
}
