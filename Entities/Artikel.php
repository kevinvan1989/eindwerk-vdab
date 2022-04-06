<?php
declare(strict_types=1);

class Artikel {
    private int $id;
    private int $eanNr;
    private string $naam;
    private string $beschrijving;
    private float $prijs;
    private int $gewicht;
    private int $voorraad;
    private int $levertijd;

    public function __construct(int $id, int $eanNr, string $naam, string $beschrijving,
    float $prijs, int $gewicht, int $voorraad, int $levertijd)
    {
        $this->id = $id;
        $this->eanNr = $eanNr;
        $this->naam = $naam;
        $this->beschrijving = $beschrijving;
        $this->prijs = $prijs;
        $this->gewicht = $gewicht;
        $this->voorraad = $voorraad;
        $this->levertijd = $levertijd;
    }

    public function getId() : int {
        return $this->id;
    }
    public function getEanNr() : int {
        return $this->eanNr;
    }
    public function getNaam() : string {
        return $this->naam;
    }
    public function getBeschrijving() : string {
        return $this->beschrijving;
    }
    public function getPrijs() : float {
        return $this->prijs;
    }
    public function getPrintPrijs() : string {
        return (fmod($this->prijs, 1) > 0 ? number_format($this->prijs, 2, ",", ".") : $this->prijs . ",-");
    }
    public function getGewicht() : int {
        return $this->gewicht;
    }
    public function getVoorraad() : int {
        return $this->voorraad;
    }
    public function getLevertijd() : int {
        return $this->levertijd;
    }
}
