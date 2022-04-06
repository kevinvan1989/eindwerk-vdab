<?php

declare(strict_types=1);

require_once __DIR__ . "/Artikel.php";

class Categorie 
{
    private int $categorieId;

    private string $naam;

    private ?array $subCategorieen;

    private bool $artikelen;

    public function __construct(int $categorieId, string $naam)
    {
        $this->categorieId = $categorieId;
        $this->naam = $naam;
        $this->subCategorieen = null;
        $this->artikelen = false;
    }

    
    public function getCategorieId(): int
    {
        return $this->categorieId;
    }

    public function getNaam(): string
    {
        return $this->naam;
    }

    public function getSubCategorieen(): ?array
    {
        return $this->subCategorieen;
    }

    public function addSubCategorie(Categorie $categorie)
    {
        if ($this->subCategorieen === null){
            $this->subCategorieen = [];
        }
        $this->subCategorieen[] = $categorie;
    }
    
    public function getArtikelen():bool
    {
        return $this->artikelen;
    }

    public function setArtikelen(bool $boolean)
    {
        $this->artikelen = $boolean;

        return $this;
    }
}
