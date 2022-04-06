        <div class="winkelmand">
            <div class="col-1">
                <h2>Winkelmand<?php if (isset($gebruiker)) echo " van " . $gebruiker->getVoornaam() ?></h2>
                <a href="index.php">
                    < Verder winkelen</a>
                        <?php
                        $teller = 0;
                        foreach ($winkelmandje->inhoud as $inhoud) {
                        ?>
                            <div class="d-flex productdetail">
                                <div class="col-50 mafb">
                                    <a href="productPagina.php?id=<?php echo $inhoud['artikel']->getId() ?>">
                                        <img src="img/dummy_img.png" alt="Foto niet beschikbaar"></img>
                                    </a>
                                </div>
                                <div class="col-50">
                                    <a href="productPagina.php?id=<?php echo $inhoud['artikel']->getId() ?>">
                                        <p class="productNaam"><?php echo $inhoud['artikel']->getNaam() ?></p>
                                    </a>
                                    <p class="productPrijsPS">Prijs per stuk:</p>
                                    <p>€ <?php echo number_format($inhoud['artikel']->GetPrijs(), 2, ",", ".") ?></p>
                                    <form action="Winkelmandje.php?action=wijzig" method="post" id="winkelmandform">
                                        <div class="col-50">
                                            <label for="aantal">Aantal:
                                                <input type="number" name="aantal[<?php echo $teller ?>]" id="aantal" value="<?php echo $inhoud['aantal'] ?>" min="0" max="<?php echo $inhoud['artikel']->getVoorraad() ?>">
                                            </label>
                                            <!-- <div class="toevoegenWinkelwagenKnoppen d-flex">
                                                <div class="col-50 d-flex">
                                                    <a href="Winkelmandje.php?action=verlaag&index=<?php echo $teller ?>">
                                                        <div id="verminderMet1" class="verminderMet1"><i class="fas fa-minus"></i></div>
                                                    </a>
                                                    <input type="number" name="aantalTeBestellen" value="<?php echo $inhoud['aantal'] ?>" id="aantalTeBestellen" class="aantalTeBestellen" min="1" max="10">

                                                    <a href="Winkelmandje.php?action=verhoog&index=<?php echo $teller ?>">
                                                        <div id="verhoogMet1" class="verhoogMet1"><i class="fas fa-plus"></i></div>
                                                    </a>
                                                </div>
                                            </div> -->
                                        </div>
                                        <input type="submit" value="Update aantal" class="btn col-50">
                                    </form>
                                    <p class="productPrijs">Totaal: € <?php echo number_format($inhoud['artikel']->getPrijs() * $inhoud['aantal'], 2, ",", ".") ?></p>
                                    <a href="Winkelmandje.php?action=verwijder&index=<?php echo $teller ?>">Verwijder <i class="fas fa-trash-alt"></i></a>
                                </div>
                            </div>
                            <hr>
                        <?php
                            $teller += 1;
                        }
                        ?>
            </div>
            <div class="totaalMandje">
                <span class="productNaam">Totaalbedrag</span>
                <span class="productPrijs"><?php echo "€ " . $totaal; ?></span>
                <p>Inclusief btw, recupel en bebat.</p>
                <form action="bestellen.php" method="POST">
                    <input type="submit" value="Bestellen" class="btn" <?php if (!isset($gebruiker) || count($winkelmandje->inhoud) === 0) echo "disabled" ?>>
                </form>
                <form action="Winkelmandje.php" method="get">
                    <input type="submit" value="Weggooien" name="action" class="btn">
                </form>
                <?php if (!isset($gebruiker)) { ?>
                    <p>*Om te kunnen bestellen moet u aangemeld zijn.</p>
                <?php } ?>
            </div>
        </div>