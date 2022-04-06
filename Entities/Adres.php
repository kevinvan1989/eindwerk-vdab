<?php
declare (strict_types = 1);

require_once __DIR__ . "/Plaats.php";

class Adres {
    private int $adresId;
    private string $straat;
    private string $huisnr;
    private string $bus;
    private Plaats $plaats;
    private bool $actief;

    public function __construct(int $adresId, string $straat, string $huisnr,
    string $bus, Plaats $plaats, bool $actief)
    {
        $this->adresId = $adresId;
        $this->straat = $straat;
        $this->huisnr = $huisnr;
        $this->bus = $bus;
        $this->plaats = $plaats;
        $this->actief = $actief;
    }

    public function getAdresId() : int {
        return $this->adresId;
    }
    public function getStraat() : string {
        return $this->straat;
    }
    public function getHuisnr() : string {
        return $this->huisnr;
    }
    public function getBus() : string {
        return $this->bus;
    }
    public function getPlaatsObject() : Plaats {
        return $this->plaats;
    }
    public function getActief() : bool {
        return $this->actief;
    }

    public function setStraat(string $straat) {
        $this->straat = $straat;
    }
    public function setHuisnr(string $huisnr) {
        $this->huisnr = $huisnr;
    }
    public function setBus(string $bus) {
        $this->bus = $bus;
    }
    public function setPlaats(Plaats $plaats) {
        $this->plaats = $plaats;
    }
    public function setActief(bool $actief) {
        $this->actief = $actief;
    }
}