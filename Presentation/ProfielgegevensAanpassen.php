<!DOCTYPE HTML>
<html>

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="css/style.css" rel="stylesheet" type='text/css' />
  <title>PrulariaCom</title>
  <script src="https://kit.fontawesome.com/a839a90515.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css2?family=Work+Sans&display=swap" rel="stylesheet">
  <link rel="shortcut icon" type="image/png" href="img/favicon.png">
  <script src="js/registratie.js" defer></script>
  <script src="js/prularia.js" defer></script>
</head>

<body>
  <!-- HOOFDING -->
  <?php include "Hoofding.php" ?>
  <!-- MAIN CONTENT -->
  <div class="wrapper d-flex main-content">

    <?php include __DIR__ . "/errorMelding.php"; ?>

    <?php include __DIR__ . "/modules/ProfielgegevensForm.php" ?>

  </div>  

  <!-- VOETTEKST -->
  <?php include_once __DIR__ . "/cookieMelding.php"; ?>

  <?php include "Voettekst.php" ?>

</body>

</html>