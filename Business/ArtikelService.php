<?php
declare(strict_types = 1);

require_once __DIR__ . "/../Data/ArtikelenDAO.php";

class ArtikelService {
    public function getBestVerkocht() : array {
        $artikelenDAO = new ArtikelenDAO();
        $lijst = $artikelenDAO->getBestVerkocht();
        return $lijst;
    }
    public function getById(int $id) : Artikel {
        $artikelenDAO = new ArtikelenDAO();
        $artikel = $artikelenDAO->getById($id);
        return $artikel;
    }
    public function getByEan(int $ean) : Artikel {
        $artikelenDAO = new ArtikelenDAO();
        $artikel = $artikelenDAO->getByEan($ean);
        return $artikel;
    }
    public function getArtById_metActueleVoorraad(int $id) : ?Artikel {
        $artikelenDAO = new ArtikelenDAO();
        $artikel = $artikelenDAO->getArtById_metActueleVoorraad($id);
        return $artikel;
    }
    public function getArtikelenByCategorieId(int $categorieId): array {
        $artikelenDAO = new ArtikelenDAO();
        $lijst = $artikelenDAO->getArtikelenByCategorieId($categorieId);
        return $lijst;
    }
}