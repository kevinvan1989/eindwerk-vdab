<?php

declare(strict_types=1);

require_once __DIR__ . "/../Business/GebruikerService.php";

$error = "";

$gebruikerService = new GebruikerService();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreer test</title>
</head>

<body>
    <h1>Alle mogelijk combinaties:</h1>
    <?php
    if ($error == "") {
        try {
            $foutWachtwoord = $gebruikerService->login("ad.ministrateur@vdab.be", "ikweetdaooknie");
        } catch (InvalidPasswordException $e) {
            $error .= "Inlog met bestaand email - fout wachtwoord: Het wachtwoord is niet correct.<br>";
        }

        try {
            $disabled = $gebruikerService->login("anoniemeKlant@prularia.com", "ikweetdaooknie");
        }  catch (DisabledUserException $e) {
            $error .= "Inlog met disabled account: Dit account is disabled.<br>";
        }
        
        try {
            $nietbestaand = $gebruikerService->login("bleepbleepbloop@buh.be", "ikweetdaooknie");     
        } catch (NonExistingUserException $e) {
            $error .= "Inlog met niet-bestaande email: Dit account bestaat niet.<br>";
        }
        
        $gebruiker = $gebruikerService->login("tweede.klant@bestaatniet.be", "KlantVanPrularia");     
        print ("<h2>" . $gebruiker->getVoornaam() . "</h2>");
        print ("<h2>" . $error . "</h2>");
    }
    ?>
</body>

</html>