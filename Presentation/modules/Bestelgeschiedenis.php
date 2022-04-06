<?php
if (!isset($gebruiker)) {
    header("Location: index.php");
    exit();
}



?>

<div class="col--right">
<h2 class="mb-0">Bestelgeschiedenis van <?php echo $gebruiker->getVoornaam() . " " . $gebruiker->getFamilienaam() ?></h2>
<?php
foreach ($alleBestellingen as $bestelling) { ?>
        <h3 class="mb-0">
        Datum van bestelling: <?php echo $bestelling->getBestelDatum() ?>
        </h3>
        <h4 class="mb-0">Status van de bestelling: <?php echo $bestelService->getStatusById($bestelling->getBestellingsStatusId()); ?></h4>
        <p>Bestelde artikelen: </p>
        <table>
            <thead>
                <tr>
                    <th>Artikel</th>
                    <th>Aantal</th>
                    <th>Prijs</th>
                    <th>Bedrag</th>
                </tr>
            </thead>

            <tbody>           
                    <?php
                    $totaalbedrag = 0;
                    $bestellijnen = $bestelling->getBestellijnen();
                    foreach ($bestellijnen as $bestellijn) {
                        $artikelId = $bestellijn->getArtikelId();
                        echo ("<tr><td>" . $artikelService->getById($artikelId)->getNaam() . "</td>");
                        echo ("<td>" . $bestellijn->getAantalBesteld() . "</td>");
                        echo ("<td>&euro; " .  number_format($artikelService->getById($artikelId)->getPrijs(), 2, ",", ".") . "</td>");
                        echo ("<td>&euro; " .  number_format($bestellijn->getAantalBesteld() * $artikelService->getById($artikelId)->getPrijs(), 2, ",", ".") . "</td>");
                        $totaalbedrag += $bestellijn->getAantalBesteld() * $artikelService->getById($artikelId)->getPrijs();
                    }        
                    ?>
            </tbody>

            <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    <td>Actiecode gebruikt:</td>
                    <td>
                        <?php
                        $actiecodeGebruikt = $bestelling->getActiecodeGebruikt();
                        if ($actiecodeGebruikt) {
                            echo ("JA");
                        } else {
                            echo ("NEEN");
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>Totaalbedrag:</td>
                    <td>
                    <?php
                    if ($actiecodeGebruikt) {
                        $totaalbedrag = (int) $totaalbedrag * 0.9;
                        echo ("&euro; " . number_format($totaalbedrag, 2, ",", "."));
                    } else {
                        echo ("&euro; " . number_format($totaalbedrag, 2, ",", "."));
                    }
                    ?>
                    </td>
                </tr>
            </tfoot>
        </table>
        <?php
}
        ?>
    </div>