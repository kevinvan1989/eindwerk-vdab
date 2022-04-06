<?php

declare(strict_types=1);

class Actiecode {
    private int $actiecodeId;
    private string $naam;
    private string $geldigVanDatum;
    private string $geldigTotDatum;
    private bool $isEenmalig;

    public function __construct(int $actiecodeId, string $naam, string $geldigVanDatum,
    string $geldigTotDatum, bool $isEenmalig)
    {
        $this->actiecodeId = $actiecodeId;
        $this->naam = $naam;
        $this->geldigVanDatum = $geldigVanDatum;
        $this->geldigTotDatum = $geldigTotDatum;
        $this->isEenmalig = $isEenmalig;
    }

    public function getActiecodeId() : int {
        return $this->actiecodeId;
    }
    public function getNaam() : string {
        return $this->naam;
    }
    public function getGeldigVanDatum() : string {
        return $this->geldigVanDatum;
    }
    public function getGeldigTotDatum() : string {
        return $this->geldigTotDatum;
    }
    public function getIsEenmalig() : bool {
        return $this->isEenmalig;
    }


    
    public function setNaam(string $naam) {
         $this->naam = $naam;
    }
    public function setGeldigVanDatum(string $geldigVanDatum) {
         $this->geldigVanDatum = $geldigVanDatum;
    }
    public function setGeldigTotDatum(string $geldigTotDatum) {
         $this->geldigTotDatum = $geldigTotDatum;
    }
    public function setIsEenmalig(bool $isEenmalig) {
         $this->isEenmalig= $isEenmalig;
    }
}