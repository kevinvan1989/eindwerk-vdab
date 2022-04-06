<div class="footerBestVerkocht col-1">
    <!-- bestverkochte artikelen -->
    <h2>Bestverkochte artikelen</h2>
    <!--<div class="d-flex overzicht-producten">-->
    <div class="footer_bestverkocht d-flex">
        <?php
        $current_url = $_SERVER['REQUEST_URI'];
        $current_url = explode("?", $_SERVER['REQUEST_URI']);
        $base_url = $current_url[0];


        for ($i = 0; $i < 6; $i++) {
        ?>
            <div class="bestverkochtItem col-6" onclick="window.location='productPagina.php?id=<?php echo ($producten[$i]->getId()) ?>'">
                <div class="clickable">
                    <img src="img/dummy_img.png" alt="Foto niet beschikbaar"></img> <!-- link naar productpagina op div-->
                    <?php
                    print('<p class="productnaam">' . $producten[$i]->getNaam() . '</p>');
                    print('<p class="productprijs">€ ' . $producten[$i]->getPrintPrijs()  . '</p>');
                    ?>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>