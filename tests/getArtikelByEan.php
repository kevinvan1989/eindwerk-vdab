<?php
//DEZE FILE MOET VERPLAATST WORDEN NAAR DE ROOT FOLDER OM TE WERKEN
//VOORLOPIG STAAT DEZE IN DE TEST FOLDER OM DE ROOT NIET VOL TE STOPPEN

require_once __DIR__ . "/../Business/ArtikelService.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test artikel by EAN</title>
</head>
<body>
    <h1>Artikel met ean: 5499999000019 = <?php
    $artikelenService = new ArtikelService();
    $artikel = $artikelenService->getByEan(5499999000064);
    print($artikel->getNaam());
    ?></h1>
</body>
</html>