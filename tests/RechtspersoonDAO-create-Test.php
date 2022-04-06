<?php

declare(strict_types=1);

require_once __DIR__ . "/../Data/RechtspersoonDAO.php";

$Rechtspersoondao= new RechtspersoonDAO;

//deze test werkt maar 1x, (tenzij je de aangemaakte rechtspersoon terug verwijderd) 
// om goed te zijn zou er nog een delete functie aan toe gevoegd moeten worden...

$Rechtspersoondao->create(5,"bnaam", "5678011.5");