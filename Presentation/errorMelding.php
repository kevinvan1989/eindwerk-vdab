<?php
$hide = "hide";
if (isset($error)) {
    $hide = "";
}
?>
<div id="error" class="<?php echo $hide ?>">
    <!-- <h2>Fout</h2> -->
    <h2>Oeps, er ging wat mis</h2>
    <p><?php echo $error ?></p>
    <button id="errorWeg" class="btn">Ok</button>
</div>