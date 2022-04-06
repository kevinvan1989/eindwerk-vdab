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
    <title>Test artikel by id</title>
</head>
<body>
    <h1>Artikel met id: 4 = <?php
    $artikelenService = new ArtikelService();
    $artikel = $artikelenService->getById(4);
    print($artikel->getNaam());
    ?></h1>
</body>
</html>