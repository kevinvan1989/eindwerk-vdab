<?php

declare(strict_types=1);

require_once __DIR__ . "/../Data/CategorieDAO.php";
require_once __DIR__ . "/../Data/ArtikelenDAO.php";
class CategorieService
{
    public function getSubCategorieenByHoofdCategorieId(?int $hoofdCategorieId = null): ?array
    {
        $categorieDAO = new CategorieDAO;
        $artikelDAO = new ArtikelenDAO;
        $categorieen = $categorieDAO->getSubCategorieenByHoofdCategorieId($hoofdCategorieId);

        if (count($categorieen) !== 0) {
            foreach ($categorieen as $categorie) {
                $categorieId = $categorie->getCategorieId();
                $artikelen = $artikelDAO->getArtikelenByCategorieId($categorieId);
                $subCategorieen = $this->getSubCategorieenByHoofdCategorieId($categorieId);

                if (count($artikelen) !== 0) {
                    $categorie->setArtikelen(true);
                }

                if (count($subCategorieen) !== 0) {
                    foreach ($subCategorieen as $subCategorie) {
                        $categorie->addSubCategorie($subCategorie);
                    }
                }
            }
        }
        return $categorieen;
    }


    public function getCategorieen(): array
    {
        return $this->getSubCategorieenByHoofdCategorieId();
    }

    public function getCategorieById(int $id): Categorie
    {
        $categorieDAO = new CategorieDAO;
        $categorie = $categorieDAO->getCategorieById($id);
        return $categorie;
    }
}
