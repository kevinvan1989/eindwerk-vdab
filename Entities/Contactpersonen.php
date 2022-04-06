<?php

declare(strict_types=1);

class Contactpersonen
{
    private int $contactpersoonId;

    private string $voornaam;

    private string $familienaam;

    private string $functie;

    private int $klantId;

    private int $gebruikersAccountId;

    public function __construct(int $contactpersoonId, string $voornaam, string $familienaam, string $functie, int $klantId, int $gebruikersAccountId)
    {
        $this->contactpersoonId = $contactpersoonId;
        $this->voornaam = $voornaam;
        $this->familienaam = $familienaam;
        $this->functie = $functie;
        $this->klantId = $klantId;
        $this->gebruikersAccountId = $gebruikersAccountId;
        
    }

    public function getContactpersoonId(): int
    {
        return $this->contactpersoonId;
    }

    public function getVoornaam(): string
    {
        return $this->voornaam;
    }

    public function setVoornaam(string $voornaam)
    {
        $this->voornaam = $voornaam;

        return $this;
    }

    public function getFamilienaam(): string
    {
        return $this->familienaam;
    }

    public function setFamilienaam(string $familienaam)
    {
        $this->familienaam = $familienaam;

        return $this;
    }
    
    public function getGebruikersAccountId(): int
    {
        return $this->gebruikersAccountId;
    }

    public function setGebruikersAccountId(int $gebruikersAccountId)
    {
        $this->gebruikersAccountId = $gebruikersAccountId;

        return $this;
    }
}