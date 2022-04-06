<?php

declare(strict_types=1);

require_once __DIR__ . "/../Data/AdressenDAO.php";

class AdresService {
    public function getAdresById(int $id): Adres
    {
        $adresDAO = new AdressenDAO;
        return $adresDAO->getAdresById($id);
    }
}