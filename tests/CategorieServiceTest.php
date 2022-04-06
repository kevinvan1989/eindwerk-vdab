<?php

declare(strict_types=1);

require_once __DIR__ . "/../Business/CategorieService.php";

$categorieService = new CategorieService;

$categorieen = $categorieService->getSubCategorieenByHoofdCategorieId(null);


// "_ " geeft bij weergave van de test de diepte weer: 
// "" = hoofdcategorie(null), 
// "_ " = 1, 
// "_ _ "=2, ...
function toon($categorieen, $dot)
{

    if (!$categorieen) return;
    foreach ($categorieen as $categorie) {
        echo "<br>" . $dot . $categorie->getNaam() . ":<br>";

        $subcategorieen = $categorie->getSubCategorieen();
        echo "heeft artikelen:" . $categorie->getArtikelen()."<br>";

        // if ($artikelen) {
        //     echo $dot . "artikelen:";
        //     foreach ($artikelen as $key => $artikel) {
        //         echo $artikel->getNaam() . ", ";
        //     }
        //     echo "<br>";
        // }

        if ($subcategorieen) {
            echo $dot . "subcategorieen: ";
            foreach ($subcategorieen as $key => $subcategorie) {
                echo $subcategorie->getNaam() . ", ";
            }
            echo "<br>";
            toon($subcategorieen, $dot . "_ ");
            echo "<br>";
        }
        echo "<br>";
    }
    
}
$dot = "";
toon($categorieen, $dot);
