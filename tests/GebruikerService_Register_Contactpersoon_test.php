<?php
declare (strict_types=1);

require_once __DIR__ . "/../Business/GebruikerService.php";

$gebruikerService = new GebruikerService();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreer Contact persoon</title>
</head>
<body>
    <h1>Contact persoon registreren:</h1>
    <ul>
    <?php
    $contactPersoon = $gebruikerService->registerContactPersoon("fakeCompany@fake.fake", "buh", "Prularia", "0000000000000",
    "Kerkstraat", "15", "A", 45, true, "Kerkstraat", "15", "A", 45, true, "Jef", "Jefson", "CEO");

    print("<li>" . $contactPersoon->getVoornaam() . "</li>");
    print("<li>" . $contactPersoon->getFamilienaam() . "</li>");
    print("<li>" . $contactPersoon->getEmailadres() . "</li>");
    print("<li>" . $contactPersoon->getPaswoord() . "</li>");
    print("<li>" . $contactPersoon->getKlantId() . "</li>");
    print("<li>" . $contactPersoon->getLeveringsAdresId()->getStraat() . "</li>");
    print("<li>" . $contactPersoon->getFacturatieAdresId()->getStraat() . "</li>");
    print("<li>" . $contactPersoon->getDisabled() . "</li>");
    print("<li>" . $contactPersoon->getGebruikersaccountId() . "</li>");
    print("<li>" . $contactPersoon->getFunctie() . "</li>");
    print("<li>" . $contactPersoon->getBedrijfsnaam() . "</li>");
    print("<li>" . $contactPersoon->getbtwNr() . "</li>");
    print("<li>" . $contactPersoon->getContactpersoonId() . "</li>");
    ?>
    </ul>

</body>
</html>