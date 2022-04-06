<!-- <!DOCTYPE html>
    <html lang="nl">
    <head> -->
<!--         <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/style.css" rel="stylesheet" type='text/css' />
        <title>Prularia - Voettekst</title>
        <script src="https://kit.fontawesome.com/a839a90515.js" crossorigin="anonymous"></script> -->
<!-- </head>
    <body> -->
<div class="full-width-footer">
    <div class="wrapper footer d-flex">

        <div class="links col-2 d-flex">
            <div class="col-3">
                <a href="#"  class="uppercase">Over Prularia</a> <!-- LINK VERVANGEN EENS GELINKTE PAGINA AANGEMAAKT KAN WORDEN -->
            </div>
            <div class="col-3">
                <a href="#"  class="uppercase">Contacteer ons</a> <!-- LINK VERVANGEN EENS GELINKTE PAGINA AANGEMAAKT KAN WORDEN -->
            </div>
            <?php if (isset($gebruiker)) { ?>
                <div class="col-3">
                    <ul>
                    <!--<li><a href="#" class="hide--mobile">Gebruiker</a></li> LINK VERVANGEN EENS GELINKTE PAGINA AANGEMAAKT KAN WORDEN -->
                        <li class="uppercase"><a href="Gebruiker.php" class="hide--mobile">Profielpagina</a></li><!-- LINK VERVANGEN EENS GELINKTE PAGINA AANGEMAAKT KAN WORDEN -->
                        <li><a href="Gebruiker.php?view=bestellingen" class="hide--mobile">Bestelgeschiedenis</a></li><!-- LINK VERVANGEN EENS GELINKTE PAGINA AANGEMAAKT KAN WORDEN -->
                        <li><a href="<?php echo $url ?>action=logout">Log uit</a></li><!-- LINK VERVANGEN EENS GELINKTE PAGINA AANGEMAAKT KAN WORDEN -->
                    </ul>
                </div>
            <?php } ?>
        </div>

        <div class="adres col-3">
            <p  class="uppercase">Prularia bvba</p>
            <p>Somersstraat 22</p>
            <p>2018 Antwerpen</p>
            <p>Copyright 2021</p>
        </div>

    </div>
</div>
<!-- </body>
</html> -->