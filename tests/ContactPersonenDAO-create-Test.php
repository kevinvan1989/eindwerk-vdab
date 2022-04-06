<?php

declare(strict_types=1);

require_once __DIR__ . "/../Data/ContactPersonenDAO.php";

$contactpersonenDAO = new ContactpersonenDAO;

echo $contactpersonenDAO->create("david", "lamm", "ontwikell", 1, 2);