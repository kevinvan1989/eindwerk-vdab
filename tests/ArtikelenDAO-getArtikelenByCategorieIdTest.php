<?php

require_once __DIR__ . "/../Data/ArtikelenDAO.php";

$artDAO=new ArtikelenDAO;
$art = $artDAO->getArtikelenByCategorieId(2);
print_r($art);