<!-- <!DOCTYPE html>
<html lang="nl">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="../css/style.css" rel="stylesheet" type='text/css' />
  <link href="css/style.css" rel="stylesheet" type='text/css' />
  <title>Prularia - Hoofding</title>
  <script src="https://kit.fontawesome.com/a839a90515.js" crossorigin="anonymous"></script>
</head>

<body> -->


<div class="full-width-header">
  <div class="wrapper header d-flex">

  <?php include_once __DIR__ . "/modules/InlogForm.php" ?>
  <?php include_once __DIR__ . "/modules/winkelmandPopUp.php" ?>
  
    <div class="logo">
      <h1 id="logo"><a href="index.php" title="Prularia" alt="Prularia logo zwart" name="prul">Prularia</a></h1>
    </div>

    <?php
    $gebruikerNaam = (isset($gebruiker) ? $gebruiker->getVoornaam() : "Gebruiker");
    ?>

    <nav class="menu--top">
      <ul>
        <li>
          <div id="login-header" class="hover--pointer">
            <i class="far fa-user menu-icoon"></i>
            <span class="hide--mobile"><?php echo $gebruikerNaam ?></span>
          </div>
          <!-- <?php //include('test'); 
                ?> -->
          <!-- Onderstaande comment wijzigen naar bovenstaande content wanneer klaar -->
          <!-- <div class="menu__login__dropdown"></div> -->
        </li>
        <li>
          <div id="mandje">
            <a href="#"><i class="fas fa-shopping-basket menu-icoon"></i>
              <span class="hide--mobile">Winkelmand</span><?php if (count($winkelmandje->inhoud)>0) echo " (".count($winkelmandje->inhoud).")" ?></a>
          </div>
        </li>
        <li class="hide--desktop menu__mobile__hamburger" id="hamburger">
          <i class="fas fa-bars"></i>
        </li>
      </ul>
    </nav>

  </div>
</div>
<div style="width:100px;"></div>