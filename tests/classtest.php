<?php

require_once __DIR__ . "/../Business/GebruikerService.php";

$gebruikerService = new GebruikerService;

$gebruiker = $gebruikerService->getGebruikerById(1);

echo get_class($gebruiker);