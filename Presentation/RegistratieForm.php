<div class="registratieformulier">
    <form action="registreren.php" method="post">
        <h2>Account aanmaken</h2>
        <span>* verplichte velden</span>
        <h4>Klantgegevens</h4>

        <label class="hidden_label">Voornaam </label>
        <input type="text" name="voornaam" required placeholder="Voornaam *" value="<?php if (isset($voornaam))echo $voornaam; ?>">

        <label class="hidden_label">Familienaam </label>
        <input type="text" name="familienaam" required placeholder="Familienaam *" value="<?php if (isset($familienaam))echo $familienaam; ?>">

        <label class="hidden_label">Emailadres </label>
        <input type="text" name="emailadres" required placeholder="E-mailadres *" value="<?php if (isset($emailadres))echo $emailadres; ?>">

        <label class="hidden_label">Wachtwoord </label>
        <input type="password" name="paswoord" required placeholder="Wachtwoord *">

        <label class="hidden_label">Wachtwoord opnieuw </label>
        <input type="password" name="paswoordOpnieuw" required placeholder="Herhaal wachtwoord *">


        <br>

        <input type="checkbox" name="rechtspersoon" id="rechtspersoon" value="true">
        <label for="rechtspersoon">Ik ben contactpersoon voor een bedrijf</label>

        <div id="rechtspersoonInput" class="hide">
            
            <label class="hidden_label">Functie </label>
            <input type="text" name="functie" placeholder="Functie">

            <h4>Bedrijf</h4>

            <label class="hidden_label">Bedrijfsnaam </label>
            <input type="text" name="bedrijfsnaam" placeholder="Bedrijfsnaam *">

            <label class="hidden_label">BTW-nummer </label>
            <input type="text" name="btwNummer" placeholder="BTW-nummer *">
        </div>
        
        <h4>Facturatieadres</h4>

        <label class="hidden_label">Straat </label>
        <input type="text" name="facturatieStraat" required placeholder="Straatnaam *" value="<?php if (isset($facturatieStraat))echo $facturatieStraat; ?>">

        <label class="hidden_label">Huisnummer </label>
        <input type="text" name="facturatieHuisnr" required placeholder="Nummer *" value="<?php if (isset($facturatieHuisnr))echo $facturatieHuisnr; ?>">

        <label class="hidden_label">Bus</label>
        <input type="text" name="facturatieBus" placeholder="Bus" value="<?php if (isset($facturatieBus))echo $facturatieBus; ?>">

        <label class="hidden_label">Plaats </label>
        <input list="facturatiePlaatsen" id="facturatiePlaatsInput" placeholder="Plaats *" value="<?php if (isset($facturatiePlaats))echo $facturatiePlaats; ?>">
        <datalist id="facturatiePlaatsen">
            <?php foreach ($plaatsenLijst as $plaats) { ?>
                <option data-value="<?php echo $plaats->getPlaatsId() ?>"><?php echo $plaats->getPostcode() . " " . $plaats->getPlaats() ?></option>
            <?php } ?>
        </datalist>
        <input type="hidden" name="facturatiePlaats" id="facturatiePlaatsInput-hidden" value="<?php if (isset($facturatiePlaatsId))echo $facturatiePlaatsId; ?>">

        <br>

        <input type="checkbox" name="apartLeverAdres" value="true" id="apartLeverAdres">
        <label for="apartLeverAdres">Leveradres verschilt van facturatieadres</label>

        <div id="leveradresInput" class="hide">
            <h4>Leveradres</h4>

            <label class="hidden_label">Straat </label>
            <input type="text" name="leverStraat" placeholder="Straatnaam *">

            <label class="hidden_label">Huisnummer </label>
            <input type="text" name="leverHuisnr" placeholder="Nummer *">

            <label class="hidden_label">Bus </label>
            <input type="text" name="leverBus" placeholder="Bus">


            <label class="hidden_label">Plaats </label>
            <input list="leverPlaatsen" id="leverPlaatsInput" placeholder="Plaats *">
            <datalist id="leverPlaatsen">
                <?php foreach ($plaatsenLijst as $plaats) { ?>
                    <option data-value="<?php echo $plaats->getPlaatsId() ?>"><?php echo $plaats->getPostcode() . " " . $plaats->getPlaats() ?></option>
                <?php } ?>
            </datalist>
            <input type="hidden" name="leverPlaats" id="leverPlaatsInput-hidden">

        </div>

        <input type="submit" name="action" value="Registreren" class="btn">
    </form>
</div>