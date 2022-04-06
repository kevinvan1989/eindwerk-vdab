<?php

declare(strict_types=1);

require_once __DIR__ . "/../Data/CategorieDAO.php";

$catDAO=new CategorieDAO;
print_r($catDAO->getCategorieBySubCategorieId(3));