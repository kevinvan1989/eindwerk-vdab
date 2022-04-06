<?php
declare(strict_types = 1);

require_once __DIR__ . "/../Business/BestellingService.php";

$bestellingService = new BestellingService();

$bestellijnen = [];

for($i=0; $i<5; $i++) {
    $bestellijnen[$i]["artikelId"] = $i+1;
    $bestellijnen[$i]["aantalBesteld"] = $i+1;
    $bestellijnen[$i]["aantalGeannuleerd"] = 0;
}

$bestelling = $bestellingService->createBestelling($bestellijnen);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bestelling doorvoeren test</title>
</head>
<body>
    <?php
    
    if($bestelling) {
        print ("<h1> BESTELLING DOORGEVOERD </h1>");
    }

    foreach($bestellijnen as $lijn) {
        print("Artikel Id: " . $lijn["artikelId"]);
        print("Aantal Besteld: " . $lijn["aantalBesteld"]);
        print("Aantal Geannuleerd: " . $lijn["aantalGeannuleerd"]);
    }

    ?>
</body>
</html>