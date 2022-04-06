<div id="winkelmandje" class="d-flex menu__login__dropdown winkelmandje hide">
    <!-- <h2>Winkelmandje</h2> -->
    <?php if (count($winkelmandje->inhoud) > 0) { ?>
        <table>
            <thead>
                <!-- <th></th> -->
                <th>Artikel</th>
                <th>Prijs per stuk</th>
                <th>Aantal</th>
                <th>Totaal</th>
            </thead>
            <?php foreach ($winkelmandje->inhoud as $inhoud) { ?>
                <tr>
                    <!-- <td><img src="img/dummy_img.png" alt="Foto niet beschikbaar"></img></td> -->
                    <td><?php echo $inhoud['artikel']->getNaam(); ?></td>
                    <td><?php echo "€ " . number_format($inhoud['artikel']->getPrijs(), 2, ",", ".") ?></td>
                    <td><?php echo $inhoud['aantal']; ?></td>
                    <td><?php echo "€ " . number_format($inhoud['artikel']->getPrijs() * $inhoud['aantal'], 2, ",", "."); ?></td>
                </tr>
            <?php } ?>
            <tr>
                <!-- <th></th> -->
                <th></th>
                <th></th>
                <th>Totaal:</th>
                <th><?php echo "€ " . $totaal; ?></th>
            </tr>
        </table>
        <form action="Winkelmandje.php" method="post">
        <input type="submit" value="Bewerken" class="btn">
        </form>
        <form action="bestellen.php" method="post">
        <input type="submit" value="Bestellen" class="btn" <?php if (!isset($gebruiker)) echo "disabled" ?>>
        </form>
    <?php } else { ?>
        <p>U hebt momenteel geen artikelen in uw winkelmandje.</p>
    <?php } ?>

</div>