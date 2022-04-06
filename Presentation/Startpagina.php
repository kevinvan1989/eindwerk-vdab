<?php

// include_once __DIR__ . "/Hoofding.php";
// include_once __DIR__ . "/InlogForm.php";
// include_once __DIR__ . "/nav-left.php";
// include_once __DIR__ . "/errorMelding.php";
// include_once __DIR__ . "/OverzichtProducten.php";
// include_once __DIR__ . "/Voettekst.php";

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
  <script src="js/dropdown.js" defer></script>
  <script src="js/prularia.js" defer></script>
</head>

<body>
  <!-- HOOFDING -->
  <?php include_once __DIR__ . "/Hoofding.php" ?>
  <!-- MAIN CONTENT -->
  <div class="wrapper d-flex main-content">

    <div class="col-3 linkerkolom">
      <div class="dropdown-navigatie hide--mobile" id='boom'>

        <?php include_once __DIR__ . "/nav-left.php" ?>

      </div>
    </div>

    <div class="col-2 rechterkolom">

      <?php include_once __DIR__ . "/errorMelding.php" ?>

      <?php include_once __DIR__ . "/OverzichtProducten.php" ?>

    </div>
  </div>

  <!-- VOETTEKST -->
  <?php include_once __DIR__ . "/cookieMelding.php"; ?>

  <?php include_once __DIR__ . "/Voettekst.php" ?>
  

</body>

</html>