<?php
require_once __DIR__ . "/../Business/ArtikelService.php";
$art = new ArtikelService;
print_r($art->getArtById_metActueleVoorraad(2));