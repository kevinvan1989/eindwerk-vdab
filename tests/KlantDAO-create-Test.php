<?php

declare(strict_types=1);

require_once __DIR__ . "/../Data/KlantDAO.php";

$klantdao= new KlantDAO;

echo $klantdao->create(1,2);