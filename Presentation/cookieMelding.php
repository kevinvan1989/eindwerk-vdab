<?php
$show = "show";
if (isset($_COOKIE['user'])) {
    $show = "hide";
}
?>
<div id="showcookie" class="<?php echo $show ?>">
    <i class="far fa-times-circle" id="close-icon"></i>
        <h3>Cookie</h3>
        <p>Om je beter en persoonlijker te helpen, gebruiken wij cookies en vergelijkbare technieken.</p>
        <p>We maken enkel gebruik van functionele cookies, waardoor je de website in al zijn glorie kan gebruiken.</p>
    <button id="cookie" class="btn">Ok, begrepen</button>
</div>