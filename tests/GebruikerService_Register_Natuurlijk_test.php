<?php
declare (strict_types=1);

require_once __DIR__ . "/../Business/GebruikerService.php";
require_once __DIR__ . "/../Data/KlantDAO.php";

$gebruikerService = new GebruikerService();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreer Natuurlijke persoon</title>
</head>
<body>
    <h1>Natuurlijke persoon registreren:</h1>
    <ul>
    <?php
    $natuurlijkePersoon = $gebruikerService->registerNatuurlijkePersoon("fake5@fake.fake", "buh", "kerkstraat", 
    "1", "A", 44, true, "kerkstraat", "1", "A", 44, true, "Johnie", "Walker");
    print("<li>" . $natuurlijkePersoon->getVoornaam() . "</li>");
    print("<li>" . $natuurlijkePersoon->getFamilienaam() . "</li>");
    print("<li>" . $natuurlijkePersoon->getEmailadres() . "</li>");
    ?>
    </ul>

</body>
</html>