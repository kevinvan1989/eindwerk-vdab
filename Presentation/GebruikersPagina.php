<?php

?>

<!DOCTYPE HTML>
<html>

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="css/style.css" rel="stylesheet" type='text/css' />
  <link href="https://fonts.googleapis.com/css2?family=Work+Sans&display=swap" rel="stylesheet">
  <link rel="shortcut icon" type="image/png" href="img/favicon.png">
  <title>PrulariaCom</title>
  <script src="https://kit.fontawesome.com/a839a90515.js" crossorigin="anonymous"></script>
  <script src="js/gebruiker.js" defer></script>
  <script src="js/prularia.js" defer></script>
</head>

<body>
  <!-- HOOFDING -->
  <?php include_once __DIR__ . "/Hoofding.php" ?>
  <!-- MAIN CONTENT -->
  <div class="wrapper d-flex main-content">

    <div class="col-3 linkerkolom">
      <div class="dropdown-navigatie hide--mobile" id='boom'>

        <?php include_once __DIR__ . "/modules/GebruikerMenu.php" ?>

      </div>
    </div>

    <div class="col-2 rechterkolom">

      <?php include_once __DIR__ . "/errorMelding.php" ?>

      <?php include_once __DIR__ . "/modules/" . $pagina . ".php" ?>

      <!-- 
    de variabele $pagina kan je klaar zetten in Gebruiker.php als er een specifieke pagina gevraagd wordt (bvb met $_GET['view']),
    je zou dan in $pagina de string "Profielpagina" kunnen meegeven als er niets gevraagd wordt, 
    of "ProfielgegevensForm" als $_GET['view']="aanpassen", enz.
    volgens dit voorbeeld zou je dan wel Profielpagina.php in de map modules moeten zetten...-->

    </div>
  </div>

  <!-- VOETTEKST -->
  <?php include_once __DIR__ . "/cookieMelding.php"; ?>

  <?php include_once __DIR__ . "/Voettekst.php" ?>

</body>

</html>