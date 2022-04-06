<?php

declare(strict_types=1);

require_once __DIR__ . "/../Data/RechtspersoonDAO.php";

$rechtspersoondao= new RechtspersoonDAO;

print_r($rechtspersoondao->getByEmailadres("ad.ministrateur@vdab.be"));