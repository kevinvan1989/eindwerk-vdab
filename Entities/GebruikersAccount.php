<?php

declare(strict_types=1);

class GebruikersAccount
{
    private int $gebruikersAccountId;

    private string $emailadres;

    private string $paswoord;

    private bool $disabled;

    public function __construct(int $gebruikersAccountId, string $emailadres, string $paswoord, bool $disabled)
    {
        $this->gebruikersAccountId = $gebruikersAccountId;
        $this->emailadres = $emailadres;
        $this->paswoord = $paswoord;
        $this->disabled = $disabled;
    }

    public function getGebruikersAccountId(): int
    {
        return $this->gebruikersAccountId;
    }

    public function getEmailadres(): string
    {
        return $this->emailadres;
    }

    public function setEmailadres(string $emailadres)
    {
        $this->emailadres = $emailadres;

        return $this;
    }

    public function getPaswoord(): string
    {
        return $this->paswoord;
    }

    public function setPaswoord(string $paswoord)
    {
        $this->paswoord = $paswoord;

        return $this;
    }

    public function getDisabled(): bool
    {
        return $this->disabled;
    }

    public function setDisabled(bool $disabled)
    {
        $this->disabled = $disabled;

        return $this;
    }
}
