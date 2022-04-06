<?php

declare(strict_types=1);

require_once __DIR__ . "/../Data/KlantDAO.php";
require_once __DIR__ . "/../Data/GebruikersAccountDAO.php";
require_once __DIR__ . "/../Data/NatuurlijkePersonenDAO.php";
require_once __DIR__ . "/../Data/ContactPersonenDAO.php";
require_once __DIR__ . "/../Data/AdressenDAO.php";
require_once __DIR__ . "/../Data/RechtspersoonDAO.php";
require_once __DIR__ . "/../Exceptions/Exceptions.php";

class GebruikerService
{
    public function getGebruikerById(int $klantId)
    {
        $rechtspersoonDAO = new RechtspersoonDAO();
        $gebruiker = $rechtspersoonDAO->getbyKlantId((int) $klantId);
        if ($gebruiker === null) {
            $klantDAO = new KlantDAO();
            $gebruiker = $klantDAO->getByKlantId((int) $klantId);
        }
        return $gebruiker;
    }

    public function login(string $emailAdres, string $paswoord)
    {
        $gebruikersAccountDAO = new GebruikersAccountDAO();
        $gebruikersAccount = $gebruikersAccountDAO->getByEmailadres($emailAdres);
        if ($gebruikersAccount !== null) {
            if ($gebruikersAccount->getDisabled()) {
                throw new DisabledUserException();
            } else {
                if (password_verify($paswoord, $gebruikersAccount->getPaswoord()) /*|| $paswoord === $gebruikersAccount->getPaswoord()*/) {
                    $rechtspersoonDAO = new RechtspersoonDAO();
                    $gebruiker = $rechtspersoonDAO->getByEmailadres($emailAdres);
                    if ($gebruiker === null) {
                        $klantDAO = new KlantDAO();
                        $gebruiker = $klantDAO->getByEmailadres($emailAdres);
                    }
                    return $gebruiker;
                } else {
                    throw new InvalidPasswordException();
                }
            }
        } else {
            throw new NonExistingUserException();
        }
        return $gebruikersAccount;
    }


    public function registerNatuurlijkePersoon(
        string $emailadres,
        string $paswoord,
        string $leveringsstraat,
        string $leveringshuisnr,
        string $leveringsbus,
        int $leveringsplaatsId,
        bool $leveringsactief = true,
        string $facturatiestraat,
        string $facturatiehuisnr,
        string $facturatiebus,
        int $facturatieplaatsId,
        bool $facturatieactief = true,
        string $voornaam,
        string $familienaam
    ): ?Klant {
        $gebruikersAccountDAO = new GebruikersAccountDAO();
        $gebruikersAccount = $gebruikersAccountDAO->create($emailadres, $paswoord);
        $gebruikersAccountId = $gebruikersAccount->getGebruikersAccountId();

        $adressenDAO = new AdressenDAO();
        $leveringsAdres = $adressenDAO->createAdres(
            $leveringsstraat,
            $leveringshuisnr,
            $leveringsbus,
            (int) $leveringsplaatsId,
            $leveringsactief = true
        );
        $leveringsAdresId = $leveringsAdres->getAdresId();

        $facturatieAdres = $adressenDAO->createAdres(
            $facturatiestraat,
            $facturatiehuisnr,
            $facturatiebus,
            (int) $facturatieplaatsId,
            $facturatieactief = true
        );
        $facturatieAdresId = $facturatieAdres->getAdresId();

        $klantDAO = new KlantDAO();
        $klantId = $klantDAO->create($facturatieAdresId, $leveringsAdresId);

        $natuurlijkePersonenDAO = new NatuurlijkePersonenDAO();
        $natuurlijkePersonenDAO->create($klantId, $voornaam, $familienaam, $gebruikersAccountId);

        $klant = $klantDAO->getByEmailadres($emailadres);

        return $klant;
    }

    public function registerContactPersoon(
        string $emailadres,
        string $paswoord,
        string $bedrijfsnaam,
        string $btwNummer,
        string $leveringsstraat,
        string $leveringshuisnr,
        string $leveringsbus,
        int $leveringsplaatsId,
        bool $leveringsactief = true,
        string $facturatiestraat,
        string $facturatiehuisnr,
        string $facturatiebus,
        int $facturatieplaatsId,
        bool $facturatieactief = true,
        string $voornaam,
        string $familienaam,
        string $functie
    ): ?Rechtspersoon {
        $gebruikersAccountDAO = new GebruikersAccountDAO();
        $gebruikersAccount = $gebruikersAccountDAO->create($emailadres, $paswoord);
        $gebruikersAccountId = $gebruikersAccount->getGebruikersAccountId();

        $adressenDAO = new AdressenDAO();
        $leveringsAdres = $adressenDAO->createAdres(
            $leveringsstraat,
            $leveringshuisnr,
            $leveringsbus,
            (int) $leveringsplaatsId,
            $leveringsactief = true
        );
        $leveringsAdresId = $leveringsAdres->getAdresId();

        $facturatieAdres = $adressenDAO->createAdres(
            $facturatiestraat,
            $facturatiehuisnr,
            $facturatiebus,
            (int) $facturatieplaatsId,
            $facturatieactief = true
        );
        $facturatieAdresId = $facturatieAdres->getAdresId();

        $rechtspersoonDAO = new RechtspersoonDAO();
        $klantId = $rechtspersoonDAO->create($bedrijfsnaam, $btwNummer, $facturatieAdresId, $leveringsAdresId);

        $contactpersonenDAO = new ContactpersonenDAO();
        $contactpersonenDAO->create($voornaam, $familienaam, $functie, $klantId, $gebruikersAccountId);

        $rechtsPersoon = $rechtspersoonDAO->getByEmailadres($emailadres);

        return $rechtsPersoon;
    }
    
    //!!Er moet voor de bestelling opnieuw gechecked worden welke klant het is zodat het nieuwe adres ingevuld wordt!!
    public function updateLeverAdres(
        int $klantId,
        string $straat,
        string $huisnr,
        string $bus,
        int $plaatsId
    ) {
        $rechtspersoonDAO = new RechtspersoonDAO();
        $gebruiker = $rechtspersoonDAO->getByKlantId((int) $klantId);
        if ($gebruiker === null) {
            $klantDAO = new KlantDAO();
            $gebruiker = $klantDAO->getByKlantId($klantId);
        }

        $adressenDAO = new AdressenDAO();
        $adressenDAO->disableAdres((int) $gebruiker->getLeveringsAdres()->getAdresId());

        $nieuwAdres = $adressenDAO->createAdres($straat, $huisnr, $bus, (int) $plaatsId, true);
        $leveringsAdresId = $nieuwAdres->getAdresId();

        $adressenDAO->updateLeverAdres((int) $klantId, (int) $leveringsAdresId);

        $gebruiker = $rechtspersoonDAO->getByKlantId((int) $klantId);
        if ($gebruiker === null) {
            $gebruiker = $klantDAO->getByKlantId($klantId);
        }
    }
    
    //!!Er moet voor de bestelling opnieuw gechecked worden welke klant het is zodat het nieuwe adres ingevuld wordt!!
    public function updateFacturatieAdres(
        int $klantId,
        string $straat,
        string $huisnr,
        string $bus,
        int $plaatsId
    ) {
        $rechtspersoonDAO = new RechtspersoonDAO();
        $gebruiker = $rechtspersoonDAO->getByKlantId((int) $klantId);
        if ($gebruiker === null) {
            $klantDAO = new KlantDAO();
            $gebruiker = $klantDAO->getByKlantId($klantId);
        }

        $adressenDAO = new AdressenDAO();
        $adressenDAO->disableAdres((int) $gebruiker->getFacturatieAdres()->getAdresId());

        $nieuwAdres = $adressenDAO->createAdres($straat, $huisnr, $bus, (int) $plaatsId, true);
        $facturatieAdresId = $nieuwAdres->getAdresId();

        $adressenDAO->updateFacturatieAdres((int) $klantId, (int) $facturatieAdresId);

        $gebruiker = $rechtspersoonDAO->getByKlantId((int) $klantId);
        if ($gebruiker === null) {
            $gebruiker = $klantDAO->getByKlantId($klantId);
        }
    }

    public function UpdateKlant(Klant $klant): Klant
    {

        $gebruikersAccountDAO= new GebruikersAccountDAO;
        $gebruikersAccountDAO->updateEmail($klant->getGebruikersAccountId(), $klant->getEmailadres());

        $huidigeKlant = $this->getGebruikerById($klant->getKlantId());
        $huidigLeverAdres = $huidigeKlant->getLeveringsAdres();
        $nieuwLeverAdres = $klant->getLeveringsAdres();

        if ($huidigLeverAdres->getStraat()!==$nieuwLeverAdres->getStraat() || 
            $huidigLeverAdres->getHuisnr()!==$nieuwLeverAdres->getHuisnr() ||
            $huidigLeverAdres->getBus()!==$nieuwLeverAdres->getBus() || 
            $huidigLeverAdres->getPlaatsObject()!=$nieuwLeverAdres->getPlaatsObject()
        ){
            $this->updateLeverAdres(
                $klant->getKlantId(), 
                $nieuwLeverAdres->getStraat(),
                $nieuwLeverAdres->getHuisnr(),
                $nieuwLeverAdres->getBus(),
                $nieuwLeverAdres->getPlaatsObject()->getPlaatsId()
            );
        }

        $huidigFacturatieAdres = $huidigeKlant->getFacturatieAdres();
        $nieuwFacturatieAdres = $klant->getFacturatieAdres();

        if ($huidigFacturatieAdres->getStraat()!==$nieuwFacturatieAdres->getStraat() || 
            $huidigFacturatieAdres->getHuisnr()!==$nieuwFacturatieAdres->getHuisnr() ||
            $huidigFacturatieAdres->getBus()!==$nieuwFacturatieAdres->getBus() || 
            $huidigFacturatieAdres->getPlaatsObject()!=$nieuwFacturatieAdres->getPlaatsObject()
        ){
            $this->updateFacturatieAdres(
                $klant->getKlantId(), 
                $nieuwFacturatieAdres->getStraat(),
                $nieuwFacturatieAdres->getHuisnr(),
                $nieuwFacturatieAdres->getBus(),
                $nieuwFacturatieAdres->getPlaatsObject()->getPlaatsId()
            );
        }

        $natuurlijkePersonenDAO= new NatuurlijkePersonenDAO;
        $natuurlijkePersonenDAO->update(
            $klant->getKlantId(), 
            $klant->getVoornaam(),
            $klant->getFamilienaam()
        );

        $klnt = $this->getGebruikerById($klant->getKlantId());
        return $klnt;
    }

    public function UpdateRechtspersoon(Rechtspersoon $rechtsPersoon): Rechtspersoon
    {
        $gebruikersAccountDAO= new GebruikersAccountDAO;
        $gebruikersAccountDAO->updateEmail($rechtsPersoon->getGebruikersAccountId(), $rechtsPersoon->getEmailadres());

        $rechtspersoonDAO = new RechtspersoonDAO;
        $rechtspersoonDAO->update(
            $rechtsPersoon->getKlantId(), 
            $rechtsPersoon->getBedrijfsnaam(), 
            $rechtsPersoon->getbtwNr()
        );

        $huidigeRechtspersoon = $this->getGebruikerById($rechtsPersoon->getKlantId());
        $huidigLeverAdres = $huidigeRechtspersoon->getLeveringsAdres();
        $nieuwLeverAdres = $rechtsPersoon->getLeveringsAdres();

        if ($huidigLeverAdres->getStraat()!==$nieuwLeverAdres->getStraat() || 
            $huidigLeverAdres->getHuisnr()!==$nieuwLeverAdres->getHuisnr() ||
            $huidigLeverAdres->getBus()!==$nieuwLeverAdres->getBus() || 
            $huidigLeverAdres->getPlaatsObject()!=$nieuwLeverAdres->getPlaatsObject()
        ){
            $this->updateLeverAdres(
                $rechtsPersoon->getKlantId(), 
                $nieuwLeverAdres->getStraat(),
                $nieuwLeverAdres->getHuisnr(),
                $nieuwLeverAdres->getBus(),
                $nieuwLeverAdres->getPlaatsObject()->getPlaatsId()
            );
        }

        $huidigFacturatieAdres = $huidigeRechtspersoon->getFacturatieAdres();
        $nieuwFacturatieAdres = $rechtsPersoon->getFacturatieAdres();

        if ($huidigFacturatieAdres->getStraat()!==$nieuwFacturatieAdres->getStraat() || 
            $huidigFacturatieAdres->getHuisnr()!==$nieuwFacturatieAdres->getHuisnr() ||
            $huidigFacturatieAdres->getBus()!==$nieuwFacturatieAdres->getBus() || 
            $huidigFacturatieAdres->getPlaatsObject()!=$nieuwFacturatieAdres->getPlaatsObject()
        ){
            $this->updateFacturatieAdres(
                $rechtsPersoon->getKlantId(), 
                $nieuwFacturatieAdres->getStraat(),
                $nieuwFacturatieAdres->getHuisnr(),
                $nieuwFacturatieAdres->getBus(),
                $nieuwFacturatieAdres->getPlaatsObject()->getPlaatsId()
            );
        }

        $contactpersonenDAO= new ContactpersonenDAO;
        $contactpersonenDAO->update(
            $rechtsPersoon->getContactpersoonId(), 
            $rechtsPersoon->getVoornaam(),
            $rechtsPersoon->getFamilienaam(),
            $rechtsPersoon->getFunctie()
        );
        $rechtsp = $this->getGebruikerById($rechtsPersoon->getKlantId());
        return $rechtsp;
    }

    public function updatePaswoord(Klant $klant)
    {
        $gebruikersAccountDAO= new GebruikersAccountDAO;
        $gebruikersAccountDAO->updatePaswoord($klant->getGebruikersAccountId(), $klant->getPaswoord());
        $klant = $this->getGebruikerById($klant->getKlantId());
        return $klant;
    }
}
