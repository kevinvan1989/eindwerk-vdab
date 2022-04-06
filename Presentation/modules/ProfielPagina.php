<?php



/* if (isset($gebruiker)) {
    $status = "show";
} else {
    $status = "hide";
    header("Location: ../index.php");
} */
?>

<div class="<?php echo $status ?>">

    <h2>Persoonlijke gegevens</h2>
    <img src="img/Adres.png" alt="Adres icoon">
    <h4>Adresgegevens</h4>
    <p class="klantNaam"> Facturatieadres </p>
    <?php
    if ($gebruiker->getFacturatieAdres()->getBus()){$bus = "bus";}else{$bus = "";} //nu wordt het woordje "bus" enkel weergegeven als er een bus is ingesteld...
    print($gebruiker->getVoornaam() . ' ' . $gebruiker->getFamilienaam());
    print('<p>' . $gebruiker->getFacturatieAdres()->getStraat() . ' ' .  $gebruiker->getFacturatieAdres()->getHuisnr() . ' '.$bus.' ' .  $gebruiker->getFacturatieAdres()->getBus() . '</p>');
    print('<p>' . $gebruiker->getFacturatieAdres()->getPlaatsObject()->getPostcode() . " " . $gebruiker->getFacturatieAdres()->getPlaatsObject()->getPlaats() . '</p>');
    ?>
    <p>&nbsp;</p>
    <p class="klantNaam"> Leveringsadres </p>
    <?php
    if ($gebruiker->getLeveringsAdres()->getBus()){$bus = "bus";}else{$bus = "";}
    print($gebruiker->getVoornaam() . ' ' . $gebruiker->getFamilienaam());
    print('<p>' . $gebruiker->getLeveringsAdres()->getStraat() . ' ' .  $gebruiker->getLeveringsAdres()->getHuisnr() . ' '.$bus.' ' .  $gebruiker->getLeveringsAdres()->getBus() . '</p>');
    print('<p>' . $gebruiker->getLeveringsAdres()->getPlaatsObject()->getPostcode() . " " . $gebruiker->getLeveringsAdres()->getPlaatsObject()->getPlaats() . '</p>');
    ?>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <img src="img/Persoon.png" alt="Persoon icoon">
    <h4>Persoonlijke gegevens</h4>
    <p class="klantNaam"> <?php print($gebruiker->getVoornaam() . ' ' . $gebruiker->getFamilienaam()); ?></p>
    <?php
    if (get_class($gebruiker) === "Rechtspersoon") {
        print('<p> Bedrijf: ' . $gebruiker->getBedrijfsnaam() . '</p>');
        print('<p> Functie: ' . $gebruiker->getFunctie() . '</p>');
        print('<p> Btw-nummer: ' . $gebruiker->getbtwNr() . '</p>');
    }
    ?>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <img src="img/Slot.png" alt="Slot icoon">
    <h4>Inloggegevens</h4>
    <p> <?php print($gebruiker->getEmailadres());  ?> </p>
</div>
<p>&nbsp;</p>
<form action="Gebruiker.php?view=aanpassen" method="post">
    <!-- action="Gebruiker.php?view=aanpassen"-->
    <input type="submit" value="Profiel aanpassen" class="btn">

</form>