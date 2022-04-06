<div class="registratieformulier">

    <h2>Profielgegevens wijzigen</h2>
    <span>* verplichte velden</span>

    <div id="mainForm" class="<?php if ($PWFoutje) echo "hide" ?>">
        <h4>Klantgegevens</h4>
        <form action="Gebruiker.php" method="post">
            <label class="hidden_label">Voornaam </label>
            <input type="text" name="voornaam" required placeholder="Voornaam *" value="<?php echo $gebruiker->getVoornaam(); ?>">
            <label class="hidden_label">Familienaam </label>
            <input type="text" name="familienaam" required placeholder="Familienaam *" value="<?php echo $gebruiker->getFamilienaam(); ?>">
            <label class="hidden_label">Emailadres </label>
            <input type="text" name="emailadres" required placeholder="E-mailadres *" value="<?php echo $gebruiker->getEmailadres(); ?>">
            <?php if (get_class($gebruiker) === 'Rechtspersoon') { ?>
                <label class="hidden_label">Functie </label>
                <input type="text" name="functie" placeholder="Functie *" value="<?php if (get_class($gebruiker) === "Rechtspersoon") echo $gebruiker->getFunctie(); ?>">
                <h4>Bedrijf</h4>
                <label class="hidden_label">Bedrijfsnaam </label>
                <input type="text" name="bedrijfsnaam" placeholder="Bedrijfsnaam *" value="<?php if (get_class($gebruiker) === "Rechtspersoon") echo $gebruiker->getBedrijfsnaam(); ?>">
                <label class="hidden_label">BTW-nummer </label>
                <input type="text" name="btwNummer" placeholder="BTW-nummer *" value="<?php if (get_class($gebruiker) === "Rechtspersoon") echo $gebruiker->getbtwNr(); ?>">
            <?php } ?>
            <h4>Facturatieadres</h4>
            <label class="hidden_label">Straat </label>
            <input type="text" name="facturatieStraat" required placeholder="Straatnaam *" value="<?php echo $gebruiker->getFacturatieAdres()->getStraat(); ?>">
            <label class="hidden_label">Huisnummer </label>
            <input type="text" name="facturatieHuisnr" required placeholder="Nummer *" value="<?php echo $gebruiker->getFacturatieAdres()->getHuisnr(); ?>">
            <label class="hidden_label">Bus</label>
            <input type="text" name="facturatieBus" placeholder="Bus" value="<?php echo $gebruiker->getFacturatieAdres()->getBus() ?>">
            <label class="hidden_label">Plaats </label>
            <input list="facturatiePlaatsen" id="facturatiePlaatsInput" placeholder="Plaats *" value="<?php
                                                                                                        echo $gebruiker->getFacturatieAdres()->getPlaatsObject()->getPostcode() . " " . $gebruiker->getFacturatieAdres()->getPlaatsObject()->getPlaats(); ?>">
            <datalist id="facturatiePlaatsen">
                <?php foreach ($plaatsenLijst as $plaats) { ?>
                    <option data-value="<?php echo $plaats->getPlaatsId() ?>"><?php echo $plaats->getPostcode() . " " . $plaats->getPlaats() ?></option>
                <?php } ?>
            </datalist>
            <input type="hidden" name="facturatiePlaats" id="facturatiePlaatsInput-hidden" value="<?php echo $gebruiker->getFacturatieAdres()->getPlaatsObject()->getPlaatsId(); ?>">
            <h4>Leveradres</h4>
            <label class="hidden_label">Straat </label>
            <input type="text" name="leverStraat" placeholder="Straatnaam *" value="<?php echo $gebruiker->getLeveringsAdres()->getStraat(); ?>">
            <label class="hidden_label">Huisnummer </label>
            <input type="text" name="leverHuisnr" placeholder="Nummer *" value="<?php echo $gebruiker->getLeveringsAdres()->getHuisnr(); ?>">
            <label class="hidden_label">Bus </label>
            <input type="text" name="leverBus" placeholder="Bus" value="<?php echo $gebruiker->getLeveringsAdres()->getBus() ?>">
            <label class="hidden_label">Plaats </label>
            <input list="leverPlaatsen" id="leverPlaatsInput" placeholder="Plaats *" value="<?php
                                                                                            echo $gebruiker->getLeveringsAdres()->getPlaatsObject()->getPostcode() . " " . $gebruiker->getLeveringsAdres()->getPlaatsObject()->getPlaats(); ?>">
            <datalist id="leverPlaatsen">
                <?php foreach ($plaatsenLijst as $plaats) { ?>
                    <option data-value="<?php echo $plaats->getPlaatsId() ?>"><?php echo $plaats->getPostcode() . " " . $plaats->getPlaats() ?></option>
                <?php } ?>
            </datalist>
            <input type="hidden" name="leverPlaats" id="leverPlaatsInput-hidden" value="<?php echo $gebruiker->getLeveringsAdres()->getPlaatsObject()->getPlaatsId(); ?>">
            <input type="submit" name="action" value="Updaten" class="btn">
        </form>
    </div>

    <div id="PWBox" class="<?php if (!$PWFoutje) echo "hide" ?>">
        <h4>Wachtwoord</h4>
        <form action="Gebruiker.php" method="post">

            <label class="hidden_label">Oud wachtwoord </label>
            <input type="password" name="oudPaswoord" required placeholder="Oud Wachtwoord *">

            <label class="hidden_label">Nieuw wachtwoord </label>
            <input type="password" name="nieuwPaswoord" required placeholder="Nieuw Wachtwoord *">

            <label class="hidden_label">Nieuw wachtwoord opnieuw </label>
            <input type="password" name="nieuwPaswoordOpnieuw" required placeholder="Herhaal Nieuw wachtwoord *">

            <input type="submit" name="action" value="Wachtwoord updaten" class="btn">

        </form>
    </div>
    <form action="">
        <button id="PWWijzigen" class="btn">Wachtwoord wijzigen</button>
    </form>

    <form action="Gebruiker.php" method="post">
        <input type="submit" value="Annuleren" class="btn">
    </form>
</div>
</div>