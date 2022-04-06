<?php
declare(strict_types=1);

class Review {
    private int $id;
    private string $nickname;
    private int $score;
    private string $commentaar;
    private string $datum;
    private int $bestellijnId;

    public function __construct(int $id, string $nickname, int $score,
    string $commentaar, string $datum, int $bestellijnId)
    {
        $this->id = $id;
        $this->nickname = $nickname;
        $this->score = $score;
        $this->commentaar = $commentaar;
        $this->datum = $datum;
        $this->bestellijnId = $bestellijnId;
    }

    public function getId() : int {
        return $this->id;
    }
    public function getNickname() : string {
        return $this->nickname;
    }
    public function getScore() : int {
        return $this->score;
    }
    public function getCommentaar() : string {
        return $this->commentaar;
    }
    public function getDatum() : string {
        return $this->datum;
    }
    public function getBestellijnId() : int {
        return $this->bestellijnId;
    }
    public function setNickname(string $nickname) {
        $this->nickname = $nickname;
    }
    public function setScore(int $score) {
        $this->score = $score;
    }
    public function setCommentaar(string $commentaar) {
        $this->commentaar = $commentaar;
    }
    public function setDatum(string $datum) {
        $this->datum = $datum;
    }
    public function setBestellijnId(int $bestellijnId) {
        $this->bestellijnId = $bestellijnId;
    }
}