<?php

require_once __DIR__ . "/../Business/ArtikelService.php";

$artDAO=new ArtikelService();
$lijst = $artDAO->getArtikelenByCategorieId(4);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test get by catId - service</title>
</head>
<body>
    <h1>Artikelen met categorie id: 4</h1>
    <ol>
    <?php
    foreach($lijst as $artikel) {
        print("<li>" . $artikel->getNaam() . "</li>");
    }
    ?>
    </ol>
</body>
</html>