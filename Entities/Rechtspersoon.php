<?php
declare(strict_types = 1);

require_once __DIR__ . "/Klant.php";

class Rechtspersoon extends Klant
{
    private string $bedrijfsNaam;
    private string $btwNr;
    private string $functie;
    private int $contactpersoonId;

    public function __construct(int $klantId, int $gebruikersaccountId, string $emailadres,
    string $paswoord, string $voornaam, string $familienaam, Adres $leveringsAdres,
    Adres $facturatieAdres, bool $disabled, string $bedrijfsNaam, string $btwNr,
    string $functie, int $contactpersoonId)
    {
        parent::__construct($klantId, $gebruikersaccountId, $emailadres, $paswoord,
        $voornaam, $familienaam, $leveringsAdres, $facturatieAdres, $disabled);
        $this->bedrijfsNaam = $bedrijfsNaam;
        $this->btwNr = $btwNr;
        $this->functie = $functie;
        $this->contactpersoonId = $contactpersoonId;
    }

    public function getBedrijfsnaam() : string {
        return $this->bedrijfsNaam;
    }
    public function getbtwNr() : string {
        return $this->btwNr;
    }
    public function getFunctie() : string {
        return $this->functie;
    }
    public function getContactpersoonId() : int {
        return $this->contactpersoonId;
    }
    
    public function setBedrijfsnaam(string $bedrijfsNaam) {
        $this->bedrijfsNaam = $bedrijfsNaam;
    }
    public function setbtwNr(string $btwNr) {
        $this->btwNr = $btwNr;
    }
    public function setFunctie(string $functie) {
        $this->functie = $functie;
    }
    public function setContactpersoonId(int $contactpersoonId) {
        $this->contactpersoonId = $contactpersoonId;
    }
}