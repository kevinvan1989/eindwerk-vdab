<div class="bestelformulier">
<h2>Overzicht van uw bestelling</h2>
<table>
    <thead>
        <tr>
            <th class="align-left">Artikel</th>
            <th>Prijs</th>
            <th>Aantal</th>
            <th>Subtotaal</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $winkelmandTotaal = 0;
        for ($i = 0; $i < count($winkelmandje->inhoud); $i++) {
            print('<tr><td class="align-left">' . $winkelmandje->inhoud[$i]['artikel']->getNaam() . "</td>");
            $artikelPrijs = $winkelmandje->inhoud[$i]['artikel']->getPrijs();
            print("<td>€" . number_format($artikelPrijs, 2, ",", ".") . "</td>");
            print("<td>" . $winkelmandje->inhoud[$i]['aantal'] . "</td>");
            $subtotaal = $winkelmandje->inhoud[$i]['artikel']->getPrijs() * $winkelmandje->inhoud[$i]['aantal'];
            $winkelmandTotaal += (int) $subtotaal;
            print("<td>€" . number_format($subtotaal, 2, ",", ".") . "</td></tr>");
        }

        
        if ($korting === true) {
            $winkelmandTotaal = $winkelmandTotaal * 0.9;
        }
        ?>
    </tbody>
    <tfoot>
        <?php print("
            <tr>
            <td></td>
            <td></td>
            <td>Totaalbedrag</td>
            <td class='groeneTekst'>€ " . number_format($winkelmandTotaal, 2, ",", ".") . "</td>
            </tr>");
        ?>
    </tfoot>
</table>

    <div class="actiecode">
        <div class="actiecodeFormulier" <?php
                                        if (isset($_SESSION["korting"])) {
                                            print("hidden");
                                        } ?>>
            <form action="bestellen.php" method="post">
            <div class="d-flex">
                <div class="col-4">
                    <p>Actiecode</p>
                </div>
                <div class="actiecodeInput">
                    <input type="text" name="actiecodeVeld" placeholder="Uw code">
                </div>
            </div>
                <button class="btn" type="submit" name="actiecodeToevoegen">VOEG ACTIECODE TOE</button>
            </form>
        </div>
        <div class="actiecodeMessage" <?php
                                        if (!isset($_SESSION["korting"])) {
                                            print("hidden");
                                        } ?>>
            <span>De actiecode is succesvol toegevoegd!</span>
        </div>
    </div>


    <div class="betaalwijze">
        <form action="bestellen.php" method="post">
        <h2>Kies uw betaalwijze</h2>
        <div class="d-flex">
            <div class="col-3">
                <label>
                    <input type="radio" name="betaalwijzeId" value="2" required>
                    Kredietkaart
                    <i class="far fa-credit-card"></i>
                </label>
            </div>
            <div class="col-3">
                <label>
                    <input type="radio" name="betaalwijzeId" value="1">
                    Overschrijving 
                    <i class="fas fa-money-check"></i>
                </label>
            </div>
        </div>

            <div class="adressen d-flex">
                <h2>Uw adresgegevens</h2>
                <div class="leveradres col-50">
                    <p><em>Leveradres</em></p>
                    <?php
                    print("<p>" . $gebruiker->getLeveringsAdres()->getStraat() . " " . $gebruiker->getLeveringsAdres()->getHuisnr() . " " . $gebruiker->getLeveringsAdres()->getBus() . "</p>");
                    print("<p>" . $gebruiker->getLeveringsAdres()->getPlaatsObject()->getPostcode() . " "
                    . $gebruiker->getLeveringsAdres()->getPlaatsObject()->getPlaats() . "</p>");
                    ?>
                </div>
                <div class="facturatieadres col-50">
                    <p><em>Facturatieadres</em></p>
                    <?php
                    print("<p>" . $gebruiker->getFacturatieAdres()->getStraat() . " " . $gebruiker->getFacturatieAdres()->getHuisnr() . " " . $gebruiker->getFacturatieAdres()->getBus() . "</p>");
                    print("<p>" . $gebruiker->getFacturatieAdres()->getPlaatsObject()->getPostcode() . " "
                        . $gebruiker->getFacturatieAdres()->getPlaatsObject()->getPlaats() . "</p>");
                    ?>
                </div>
            </div>

            <button class="btn" name="bestel" type="submit">BESTELLEN</button>
        </form>
    </div>

</div>