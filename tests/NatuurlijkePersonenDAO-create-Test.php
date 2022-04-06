<?php

declare(strict_types=1);

require_once __DIR__ . "/../Data/NatuurlijkePersonenDAO.php";

$Rechtspersoondao= new NatuurlijkePersonenDAO;

//deze test werkt maar 1x, (tenzij je de aangemaakte NatuurlijkePersoon terug verwijderd) 
// om goed te zijn zou er nog een delete functie aan toe gevoegd moeten worden...

$Rechtspersoondao->create(1, "david", "lammens", 1);