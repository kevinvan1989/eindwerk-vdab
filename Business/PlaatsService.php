<?php

declare(strict_types=1);

require_once __DIR__ . "/../Data/PlaatsenDAO.php";

class PlaatsService{
    public function getPlaatsen(): array
    {
        $plaatsenDAO = new PlaatsenDAO;
        return $plaatsenDAO->getAll();
    }
    
    public function getPlaatsById(int $id): Plaats
    {
        $plaatsenDAO = new PlaatsenDAO;
        return $plaatsenDAO->getById($id);
    }
}