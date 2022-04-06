<?php

declare(strict_types=1);

require_once __DIR__ . "/../Data/AdressenDAO.php";

$Adressendao= new AdressenDAO;

print_r($Adressendao->getAdresById(1));