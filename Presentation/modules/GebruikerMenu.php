<?php if (isset($gebruiker)) { ?>
    <div class="gebruikerMenu aangemeld">
        <h4>Overzicht van <?php echo $gebruiker->getVoornaam() ?></h4>
        <ul>
            <li class="<?php if (strpos($url, "bestellingen")) echo "selected" ?>">
                <a href="Gebruiker.php?view=bestellingen">Bestelgeschiedenis</a>
            </li>
            <li class="<?php if (strpos($url, "Gebruiker.php") && !strpos($url, "bestellingen")) echo "selected" ?>">
                <a href="Gebruiker.php">Persoonlijke gegevens</a>
            </li>
            <li class="<?php if (strpos($url, "Winkelmandje.php")) echo "selected" ?>">
                <a href="Winkelmandje.php">Winkelmand</a>
            </li>
            <li>
                <a href="<?php echo $url ?>action=logout">Uitloggen</a>
            </li>
        </ul>
    </div>
<?php } else { ?>
    <div class="gebruikerMenu afgemeld">
        <h4>Aanmelden</h4>
        <form action="<?php echo $url ?>" method="post">
            <label for="emailadres" <?php echo $hidden ?> class="hidden_label">Emailadres *</label>
            <input type="text" name="emailadres" id="emailadres" placeholder="E-mailadres">
            <label for="paswoord" <?php echo $hidden ?> class="hidden_label">Wachtwoord *</label>
            <input type="password" name="paswoord" id="paswoord" placeholder="Wachtwoord">
            <input type="submit" name="action" value="Login" class="btn">
        </form>
        <a href="registreren.php" <?php echo $hidden ?>>Ik heb nog geen account</a>
    </div>
<?php } ?>