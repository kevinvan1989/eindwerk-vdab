<?php

declare(strict_types=1);

require_once __DIR__ . "/Business/CategorieService.php";
require_once __DIR__ . "/Business/ArtikelService.php";
require_once __DIR__ . "/Exceptions/Exceptions.php";
require_once __DIR__ . "/controller-bootstraps/algemeneBootstrap.php";


$categorieService = new CategorieService;
$artikelService = new ArtikelService;

$lijstArtikelen = [];
$lijstCategorieën = [];

try {
    $lijstCategorieën = $categorieService->getCategorieen();
    if (isset($_GET['categorieId'])) {
        $categorieId = (int) $_GET['categorieId'];
        $lijstArtikelen = $artikelService->getArtikelenByCategorieId($categorieId);
        $categorie = $categorieService->getCategorieById($categorieId);
        $titel = $categorie->getNaam();
    } else {
        $lijstArtikelen = $artikelService->getBestVerkocht();
        $titel = "Bestverkochte producten";
    }
} catch (DBConnectionException $e) {
    $error = "Oeps, er ging iets mis";
}

include_once __DIR__ . "/Presentation/Startpagina.php";
