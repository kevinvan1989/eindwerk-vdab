<?php
declare(strict_types = 1);

class Plaats {
    private int $plaatsId;
    private string $postcode;
    private string $plaats;

    public function __construct(int $plaatsId, string $postcode, string $plaats)
    {
        $this->plaatsId = $plaatsId;
        $this->postcode = $postcode;
        $this->plaats = $plaats;
    }

    public function getPlaatsId() : int {
        return $this->plaatsId;
    }
    public function getPostcode() : string {
        return $this->postcode;
    }
    public function getPlaats() : string {
        return $this->plaats;
    }
    
    
    public function setPlaatsId(int $plaatsId) {
        $this->plaatsId = $plaatsId;
    }
    public function setPostcode(string $postcode) {
        $this->postcode = $postcode;
    }
    public function setPlaats(string $plaats) {
        $this->plaats = $plaats;
    }
}