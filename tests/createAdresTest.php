<?php
declare (strict_types = 1);

require_once __DIR__ . "/../Data/AdressenDAO.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test aanmaken Adres</title>
</head>
<body>
    <h1>Aangemaakt adres:</h1>
    <br>
    <h2>
    <?php
    $adressenDAO = new AdressenDAO();
    $adres = $adressenDAO->createAdres("Kerkstraat", "1", "A", 5);
    print($adres->getStraat() . ", " . $adres->getHuisnr() . ", " . $adres->getPlaatsObject()->getPlaats());
    ?>
    </h2>
</body>
</html>