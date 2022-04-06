<?php

declare(strict_types=1);

class NatuurlijkePersoon
{
    private int $klantId;

    private string $voornaam;

    private string $familienaam;

    private int $gebruikersAccountId;

    public function __construct(int $klantId, string $voornaam, string $familienaam, int $gebruikersAccountId)
    {
        $this->klantId = $klantId;
        $this->voornaam = $voornaam;
        $this->familienaam = $familienaam;
        $this->gebruikersAccountId = $gebruikersAccountId;
    }

    public function getKlantId(): int
    {
        return $this->klantId;
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
}
