<?php

declare(strict_types=1);

require_once __DIR__ . "/Adres.php";

class Klant
{
    private int $klantId;
    private int $gebruikersaccountId;
    private string $emailadres;
    private string $paswoord;
    private string $voornaam;
    private string $familienaam;
    private Adres $leveringsAdres;
    private Adres $facturatieAdres;
    private bool $disabled;

    public function __construct(int $klantId, int $gebruikersaccountId, string $emailadres,
        string $paswoord, string $voornaam, string $familienaam, Adres $leveringsAdres,
        Adres $facturatieAdres, bool $disabled) 
        {
        $this->klantId = $klantId;
        $this->gebruikersaccountId = $gebruikersaccountId;
        $this->emailadres = $emailadres;
        $this->paswoord = $paswoord;
        $this->voornaam = $voornaam;
        $this->familienaam = $familienaam;
        $this->leveringsAdres = $leveringsAdres;
        $this->facturatieAdres = $facturatieAdres;
        $this->disabled = $disabled;
    }

    public function getKlantId() : int {
        return $this->klantId;
    }
    public function getGebruikersaccountId() : int {
        return $this->gebruikersaccountId;
    }
    public function getEmailadres() : string {
        return $this->emailadres;
    }
    public function getPaswoord() : string {
        return $this->paswoord;
    }
    public function getVoornaam() : string {
        return $this->voornaam;
    }
    public function getFamilienaam() : string {
        return $this->familienaam;
    }
    public function getLeveringsAdres() : Adres {
        return $this->leveringsAdres;
    }
    public function getFacturatieAdres() : Adres {
        return $this->facturatieAdres;
    }
    public function getDisabled() : bool {
        return $this->disabled;
    }


    public function setKlantId(int $klantId) {
        $this->klantid = $klantId;
    }
    public function setGebruikersaccountId(int $gebruikersaccountId) {
        $this->gebruikersaccountId = $gebruikersaccountId;
    }
    public function setEmailadres(string $emailadres) {
        $this->emailadres = $emailadres;
    }
    public function setPaswoord(string $paswoord) {
        $this->paswoord = $paswoord;
    }
    public function setVoornaam(string $voornaam) {
        $this->voornaam = $voornaam;
    }
    public function setFamilienaam(string $familienaam) {
        $this->familienaam = $familienaam;
    }
    public function setLeveringsAdres(Adres $leveringsAdres) {
        $this->leveringsAdres = $leveringsAdres;
    }
    public function setFacturatieAdres(Adres $facturatieAdres) {
        $this->facturatieAdres = $facturatieAdres;
    }
    public function setDisabled(bool $disabled) {
        $this->disabled = $disabled;
    }
}