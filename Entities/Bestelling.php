<?php

declare(strict_types=1);

class Bestelling
{
    private int $bestelId;
    private string $bestelDatum;
    private int $klantId; //<- op basis hiervan halen we de bedrijfs/persoonsgegevens op in de klantDAO/rechtspersoonDAO
    private string $voornaam;
    private string $familienaam;
    private string $bedrijfsnaam;
    private string $btwNummer;
    private bool $betaald;
    private string $betalingsCode;
    private int $betaalwijzeId;
    private int $bestellingsStatusId;
    private bool $actiecodeGebruikt;
    private array $bestellijnen;
    private bool $annulatie;
    private string $annulatieDatum;
    private string $terugbetalingsCode;
    
    public function __construct(int $bestelId, string $bestelDatum, int $klantId, string $voornaam,
    string $familienaam, ?string $bedrijfsnaam, ?string $btwNummer,
    bool $betaald = false, string $betalingsCode, int $betaalwijzeId, int $bestellingsStatusId,
    bool $actiecodeGebruikt = false, array $bestellijnen, bool $annulatie, ?string $annulatieDatum, ?string $terugbetalingsCode
    ) {
        $this->bestelId = $bestelId;
        $this->bestelDatum = $bestelDatum;
        $this->klantId = $klantId;
        $this->betaald = $betaald;
        $this->betalingsCode = $betalingsCode;
        $this->betaalwijzeId = $betaalwijzeId;
        $this->bestellingsStatusId = $bestellingsStatusId;
        $this->actiecodeGebruikt = $actiecodeGebruikt;
        $this->bestellijnen = $bestellijnen;
    }
    
    public function getBestelId(): int
    {
        return $this->bestelId;
    }
    public function getBestelDatum(): string
    {
        return $this->bestelDatum;
    }
    public function getKlantId(): int
    {
        return $this->klantId;
    }
    public function getVoornaam(): string
    {
        return $this->voornaam;
    }
    public function getFamilienaam(): string
    {
        return $this->familienaam;
    }
    public function getBedrijfsnaam(): string
    {
        return $this->bedrijfsnaam;
    }
    public function getBtwNummer(): string
    {
        return $this->btwNummer;
    }
    public function getBetaald(): bool
    {
        return $this->betaald;
    }
    public function getBetalingsCode(): string
    {
        return $this->betalingsCode;
    }
    public function getBetaalwijzeId(): int
    {
        return $this->betaalwijzeId;
    }
    public function getBestellingsStatusId(): int
    {
        return $this->bestellingsStatusId;
    }
    public function getActiecodeGebruikt(): bool
    {
        return $this->actiecodeGebruikt;
    }
    public function getBestellijnen(): array
    {
        return $this->bestellijnen;
    }
    public function getAnnulatie(): bool
    {
        return $this->annulatie;
    }
    public function getAnnulatieDatum() : ?string {
        return $this->annulatieDatum;
    }
    public function getTerugbetalingsCode() : ?string {
        return $this->terugbetalingsCode;
    }
    
    public function setBestelId(int $bestelId)
    {
        $this->bestelId = $bestelId;
    }
    public function setBestelDatum(string $bestelDatum)
    {
        $this->bestelDatum = $bestelDatum;
    }
    public function setKlantId(int $klantId)
    {
        $this->klantId = $klantId;
    }
    public function setVoornaam(string $voornaam)
    {
        $this->voornaam = $voornaam;
    }
    public function setFamilienaam(string $familienaam)
    {
        $this->familienaam = $familienaam;
    }
    public function setBedrijfsnaam(string $bedrijfsnaam)
    {
        $this->bedrijfsnaam = $bedrijfsnaam;
    }
    public function setBtwNummer(int $btwNummer)
    {
        $this->btwNummer = $btwNummer;
    }
    public function setBetaald(bool $betaald)
    {
        $this->betaald = $betaald;
    }
    public function setBetalingsCode(string $betalingsCode)
    {
        $this->betalingsCode = $betalingsCode;
    }
    public function setBetaalwijzeId(int $betaalwijzeId)
    {
        $this->betaalwijzeId = $betaalwijzeId;
    }
    public function setBestellingsStatusId(int $bestellingsStatusId)
    {
        $this->bestellingsStatusId = $bestellingsStatusId;
    }
    public function setActiecodeGebruikt(bool $actiecodeGebruikt)
    {
        $this->actiecodeGebruikt = $actiecodeGebruikt;
    }
    public function setBestellijnen(array $bestellijnen)
    {
        $this->bestellijnen = $bestellijnen;
    }
    public function setAnnulatie(bool $annulatie) {
        $this->annulatie = $annulatie;
    }
    public function setAnnulatieDatum(string $annulatieDatum) {
        $this->annulatieDatum = $annulatieDatum;
    }
    public function setTerugbetalingsCode(string $terugbetalingsCode) {
        $this->terugbetalingsCode = $terugbetalingsCode;
    }
}
