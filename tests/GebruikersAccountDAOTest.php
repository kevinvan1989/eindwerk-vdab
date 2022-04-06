<?php

declare(strict_types=1);

require_once __DIR__ . "/../Data/GebruikersAccountDAO.php";

$gebrAccDAO=new GebruikersAccountDAO;

$nieuwAccount = $gebrAccDAO->create("davidt@test.be", "Wachtwoord");

echo "nieuw account:<br>";
print_r($nieuwAccount);

echo "getById:";

$getbyid = $gebrAccDAO->getById($nieuwAccount->getGebruikersAccountId());

print_r($getbyid);

echo "getByEmail";

$getbymail = $gebrAccDAO->getByEmailadres($nieuwAccount->getEmailadres());

print_r($getbymail);