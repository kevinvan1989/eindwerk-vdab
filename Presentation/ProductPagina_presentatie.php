<!DOCTYPE HTML>
<html>

<head>
<link href="https://fonts.googleapis.com/css2?family=Work+Sans&display=swap" rel="stylesheet">
<link rel="shortcut icon" type="image/png" href="img/favicon.png">
</head>

<body>
    <script src="js/addAantalToWinkelwagen.js" defer></script>

    <!-- Alles van presentatie 1 product -->
    <?php
    print("<h2>" . $product->getNaam() . "</h2>");
    ?>
    <div class="d-flex productdetail">
        <div class="col-50">
            <img src="img/dummy_img.png" alt="Foto niet beschikbaar"></img>
        </div>
        <div class="col-50 rechts">
            <?php
            print('<p class="productNaam">' . $product->getNaam() . '</p>');
            print('<p class="productPrijs">€ ' . $product->GetPrintPrijs() . '</p>');
            print('<p class="productBeschrijving">' . $product->getBeschrijving() . '</p>');
            print('<p class="productGewicht">Gewicht: ' . $product->getGewicht() . ' gram</p>');
            print('<p class="productEAN">EAN: ' . $product->getEanNr() . '</p>');
            print('<p class="productVoorraad <?php echo $disabledState; ?>">' . $product->getVoorraad() . ' stuk(s) op voorraad</p>');
            ?>
            <!-- knoppen toevoegen voor aantal en toevoegen -->
            <form action="productPagina.php?id=<?php echo $productId ?>" method="post">
                <div class="toevoegenWinkelwagenKnoppen d-flex">
                    <div class="col-50 plusMinKnoppen d-flex ">
                        <div id="verminderMet1" class="verminderMet1"><i class="fas fa-minus"></i></div>
                        <input type="number" name="aantalTeBestellen" value="1" id="aantalTeBestellen" class="aantalTeBestellen" min="0" max="<?php echo $maxBestellenVoorraad ?>"> <!-- max="< ?php echo ('$maxBestellenVoorraad') ?>">< ?php echo $product->getVoorraad() ?> -->
                        <input type="hidden" name="action" value="voegToe">
                        <input type="hidden" name="id" value="<?php echo $productId ?>">
                        <div id="verhoogMet1" class="verhoogMet1"><i class="fas fa-plus"></i></div>
                    </div>
                    <div class="col-50">
                        <button class="btn <?php echo $disabledState; ?>" <?php echo $disabledState; ?> ><i class="fas fa-cart-plus"></i></button>
                    </div>
                </div>
            </form>

        </div>

        <!-- reviews toevoegen -->

        <div class="reviewOverzicht col-1">
            <?php
            if ($reviews) {
            ?>
                <h3>Dit vonden anderen van het product</h3>
            <?php
                foreach ($reviews as $review) {
                    print('<p><span class="klantNaam">' . $review->getNickname());
                    print("</span> | " . $review->getDatum() . "</p>");
                    print('<div class="reviewScore">');
                    $score = $review->getScore();
                    for ($i = 0; $i < $score; $i++) {
                        print('<i class="fas fa-star"></i>');
                        //print("&#9733;");               // vervangen met font awesome icoon
                    }
                    for ($i = $score; $i < 5; $i++) {
                        print('<i class="far fa-star"></i>');
                        //print("&#9734;");               // vervangen met font awesome icoon
                    }
                    print('</div>');
                    print("<p>" . $review->getCommentaar() . "</p>");
                }
            }
            ?>
        </div>
    </div>


</body>

</html>