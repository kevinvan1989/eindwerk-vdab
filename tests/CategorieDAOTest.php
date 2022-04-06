<?php

declare(strict_types=1);

require_once __DIR__ . "/../Data/CategorieDAO.php";

$categorieDAO = new CategorieDAO;

$categorieen = $categorieDAO->getSubCategorieenByHoofdCategorieId(null);

var_dump($categorieen);