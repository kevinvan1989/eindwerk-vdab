<?php

declare(strict_types=1);

echo "<ul class='lijst__hoofdcategorieen'>";



foreach ($lijstCategorieën as $hoofdcategorie) {
    $gevuld=false;
    if ($hoofdcategorie->getArtikelen()) {
        $label = '<a href="index.php?categorieId=' . $hoofdcategorie->getCategorieId() . '">' . $hoofdcategorie->getNaam() . '</a>';
        $gevuld=true;
    } else {
        $label = $hoofdcategorie->getNaam();

    }

    if ($hoofdcategorie->getSubCategorieen()!==null) {
        $subCategorie1 = $hoofdcategorie->getSubCategorieen();
        $gevuld=true;
    } 
    else {
        $subCategorie1 = array();
    }

    if ($gevuld===true){
        echo '<li class="hoofdcategorie">' . '<span class="categorie">' . $label . "</span>";
    }
    
    echo '<ul class="lijst__subcategorieen">';
    
    foreach ($subCategorie1 as $subcategorie) {
        $gevuld=false;
        if ($subcategorie->getArtikelen()) {
            $label = '<a href="index.php?categorieId=' . $subcategorie->getCategorieId() . '">' . $subcategorie->getNaam() . '</a>';
            $gevuld=true;
        } else {
            $label = $subcategorie->getNaam();
        }
        
        if ($subcategorie->getSubCategorieen() !== null) {
            $subCat2 = $subcategorie->getSubCategorieen();
            $gevuld=true;
        }else $subcat2 = array();

        if ($gevuld===true) {
            echo "<li class='subcategorie'>" . '<span class="categorie">' . $label . "</span>";
        }
        
            echo "<ul class='lijst__sub__subcategorieen hide'>";
            
            foreach ($subCat2 as $subCat3) {
                $gevuld=false;
                if ($subCat3->getArtikelen()) {
                    $label = '<a href="index.php?categorieId=' . $subCat3->getCategorieId() . '">' . $subCat3->getNaam() . '</a>';
                    $gevuld=true;
                } else {
                    $label = $subCat3->getNaam();
                }
                if ($gevuld===true){
                    echo "<li class='sub__subcategorieen'>" . '<span class="categorie ">' . $label . "</span></li>";
                }
                
            }
            echo "</ul>";
        
        echo "</li>";
    }
    echo "</ul>";

    echo "</li>"; // Einde li per hoofdcategorie
}
echo "</ul>";
