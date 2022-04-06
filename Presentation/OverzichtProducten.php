<h2><?php if (isset($titel)) echo $titel ?></h2>

<div class="d-flex overzicht-producten">
    <!-- dummy content -->
    <?php
    foreach ($lijstArtikelen as $product) {
    ?>
        <div class="bestverkocht col-4" onclick="window.location='productPagina.php?id=<?php echo ($product->getId()) ?>'">
        <?php
        print('<img src="img/dummy_img.png" alt="Foto niet beschikbaar"></img>');

        print('<div>');
        print('<p class="productnaam">');
        print($product->getNaam());
        print('</p>');

        print('<p class="productprijs">');
        print("€ " . $product->getPrintPrijs());
        print('</p>');
        print('</div>');
        print('</div>');
    }
        ?>

        </div>