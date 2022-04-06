<?php

declare(strict_types=1);

require_once __DIR__ . "/../Data/KlantDAO.php";

$klantdao= new KlantDAO;

print_r($klantdao->getByEmailadres("eerste.klant@bestaatniet.be"));