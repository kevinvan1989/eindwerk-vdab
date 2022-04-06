<?php
//DEZE FILE MOET VERPLAATST WORDEN NAAR DE ROOT FOLDER OM TE WERKEN
//VOORLOPIG STAAT DEZE IN DE TEST FOLDER OM DE ROOT NIET VOL TE STOPPEN

require_once __DIR__ . "/../Data/ArtikelenDAO.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Best verkocht test</title>
</head>
<body>
    <ul>
    <?php
    $artikelenDAO = new ArtikelenDAO();
    $lijst = $artikelenDAO->getBestVerkocht();
    foreach($lijst as $artikel) {
        print("<li>" . $artikel->getNaam() . ", €" . $artikel->getPrijs() . "</li>");
    }
    ?>
    </ul>
</body>
</html>