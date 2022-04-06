<?php

declare(strict_types=1);

require_once __DIR__ . "/../Business/GebruikerService.php";
$gebruikerService = new GebruikerService();
$gebruiker = $gebruikerService->getGebruikerById(16);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test Update adressen</title>
</head>

<body>
    <h2>Leveradres voor update:</h2>
    <?php
    print("<p>" . $gebruiker->getLeveringsAdres()->getStraat() . ", " . $gebruiker->getLeveringsAdres()->getHuisnr() .
        ", " . $gebruiker->getLeveringsAdres()->getBus() . ", " . $gebruiker->getLeveringsAdres()->getPlaatsObject()->getPostcode()
        . " " . $gebruiker->getLeveringsAdres()->getPlaatsObject()->getPlaats());
    ?>
    <h2>Facturatieadres voor update:</h2>
    <?php
    print("<p>" . $gebruiker->getFacturatieAdres()->getStraat() . ", " . $gebruiker->getFacturatieAdres()->getHuisnr() .
        ", " . $gebruiker->getFacturatieAdres()->getBus() . ", " . $gebruiker->getFacturatieAdres()->getPlaatsObject()->getPostcode()
        . " " . $gebruiker->getFacturatieAdres()->getPlaatsObject()->getPlaats());
    ?>
    <p>----------------------------------------------------------------------------------------------------------------------------</p>

<?php
$gebruikerService->updateLeverAdres(16, "Hondstraat", "5A", "C", 423);
$gebruikerService->updateFacturatieAdres(16, "Katstraat", "12", "E", 953);
$gebruiker = $gebruikerService->getGebruikerById(16);
?>

    <h2>Leveradres na update:</h2>
    <?php
    print("<p>" . $gebruiker->getLeveringsAdres()->getStraat() . ", " . $gebruiker->getLeveringsAdres()->getHuisnr() .
        ", " . $gebruiker->getLeveringsAdres()->getBus() . ", " . $gebruiker->getLeveringsAdres()->getPlaatsObject()->getPostcode()
        . " " . $gebruiker->getLeveringsAdres()->getPlaatsObject()->getPlaats());
    ?>
    <h2>Facturatieadres na update:</h2>
    <?php
    print("<p>" . $gebruiker->getFacturatieAdres()->getStraat() . ", " . $gebruiker->getFacturatieAdres()->getHuisnr() .
        ", " . $gebruiker->getFacturatieAdres()->getBus() . ", " . $gebruiker->getFacturatieAdres()->getPlaatsObject()->getPostcode()
        . " " . $gebruiker->getFacturatieAdres()->getPlaatsObject()->getPlaats());
    ?>
</body>

</html>