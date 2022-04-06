<?php

if (isset($gebruiker)) {
    $value = "Logout";
    $hidden = "hidden";
} else {
    $value = "Login";
    $hidden = "required";
}
?>

<div id="inlogForm" class="hide menu__login__dropdown">
    <!-- <h2><?php echo $value ?></h2> -->
    <?php if (isset($gebruiker)){ ?>
        <form action="Gebruiker.php" method="post">
        <input type="submit" value="Profielpagina" class="btn">
        </form>
        <form action="Gebruiker.php?view=bestellingen" method="post">
        <input type="submit" value="Bestellingen" class="btn">
        </form>
    <?php } ?>
    <form action="<?php echo $url ?>" method="post">
        <label for="emailadres" <?php echo $hidden ?> class="hidden_label">Emailadres *</label>
        <input type="text" name="emailadres" id="emailadres" <?php echo $hidden ?> placeholder="E-mailadres">
        <label for="paswoord" <?php echo $hidden ?> class="hidden_label">Wachtwoord *</label>
        <input type="password" name="paswoord" id="paswoord" <?php echo $hidden ?> placeholder="Wachtwoord">
        <input type="submit" name="action" value="<?php echo $value ?>" class="btn">
    </form>
    <a href="registreren.php"<?php echo $hidden ?>>Ik heb nog geen account</a>
</div>