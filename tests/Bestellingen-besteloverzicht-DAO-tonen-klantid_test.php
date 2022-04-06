<?php
declare(strict_types=1);

require_once __DIR__ . "/../Data/BestellingenDAO.php";
require_once __DIR__ . "/../Business/ArtikelService.php";

$bestellingenDAO = new BestellingenDAO();
$artikelService = new ArtikelService();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test haal bestellingen op per klant</title>
</head>
<body>
    <ul>
    <h2>Klant: 14 (heeft bestellingen)</h2>
    <?php
    $lijst14 = $bestellingenDAO->getByKlantId(14);
    foreach($lijst14 as $bestelling) {
        print("<li>" . $bestelling->getBestelId());
        foreach($bestelling->getBestellijnen() as $bestellijn) {
            print("<li>" . $artikelService->getById($bestellijn->getArtikelId())->getNaam() .
            ", " . $bestellijn->getAantalBesteld() . "stuk(s), €" . 
            $artikelService->getById($bestellijn->getArtikelId())->getPrijs()*$bestellijn->getAantalBesteld() . 
            "</li>");
        }
        print("</li>");
    }
    ?>
    </ul>
    <ul>
    <h2>Klant: 6 (heeft geen bestellingen)</h2>
    <?php
    $lijst6 = $bestellingenDAO->getByKlantId(6);
    foreach($lijst6 as $bestelling) {
        print("<li>" . $bestelling->getBestelId());
        foreach($bestelling->getBestellijnen() as $bestellijn) {
            print("<li>" . $bestellijn->getArtikelId()->getNaam() .
            ", " . $bestellijn->getAantalBesteld() . ", €" . 
            $bestellijn->getArtikelId()->getPrijs()*$bestellijn->getAantalBesteld() . 
            "</li>");
        }
        print("</li>");
    }
    ?>
    </ul>
</body>
</html>