<?php

declare(strict_types=1);

require_once __DIR__ . "/Business/ArtikelService.php";
require_once __DIR__ . "/Business/CategorieService.php";
require_once __DIR__ . "/Business/ReviewService.php";
require_once __DIR__ . "/controller-bootstraps/algemeneBootstrap.php";

$categorieService = new CategorieService;
$lijstCategorieën = $categorieService->getCategorieen();

if (isset($_POST['action']) && $_POST['action'] === 'voegToe') {
    if ((int) $_POST['aantalTeBestellen'] > 0) {
        $artikelService = new ArtikelService;
        $artikel = $artikelService->getArtById_metActueleVoorraad((int) $_GET['id']);
        $mandje = unserialize($_SESSION['winkelmandje'], ['stdClass']);
        $zelfde = false;
        for ($i=0; $i < count($mandje->inhoud); $i++) { 
            if ($mandje->inhoud[$i]['artikel']->getId() === (int) $_GET['id']) {
                $mandje->inhoud[$i]['aantal'] += (int) $_POST['aantalTeBestellen'];
                $zelfde = true;
            }
        }
        if ($zelfde === false) {
            $mandje->inhoud[] = ['artikel' => $artikel, 'aantal' => (int) $_POST['aantalTeBestellen']];
        }
        $_SESSION['winkelmandje'] = serialize($mandje);
        $winkelmandje = $mandje;
        $totaal = 0;
        foreach ($winkelmandje->inhoud as $key => $value) {
            $totaal += $value['artikel']->getPrijs() * $value['aantal'];
        }
        $totaal = number_format($totaal, 2, ",", ".");
    }
}

if (isset($_GET["id"])) {
    $productId = $_GET["id"];
    $artikelService = new ArtikelService();
    $product = $artikelService->getArtById_metActueleVoorraad((int) $productId);
    $producten = $artikelService->getBestVerkocht();

    $reviewService = new ReviewService();
    $reviews = $reviewService->getAllReviews((int) $productId);
} else {
    header("Location: index.php");
}

$maxBestellenVoorraad = $product->getVoorraad();

if ($maxBestellenVoorraad <= 0) {
    $disabledState = "disabled";
} else {
    $disabledState = "";
}

include_once __DIR__ . "/Presentation/ProductDetail.php";