<?php
declare(strict_types = 1);

require_once __DIR__ . "/DBConfig.php";
require_once __DIR__ . "/../Entities/Review.php";

class ReviewsDAO {
    //Haal alle reviews op van 1 product (parameter = artikelId)
    public function getAll(int $id) : array {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $sql = "SELECT klantenReviewId, nickname, score, commentaar,
        datum, klantenreviews.bestellijnId, artikelId  from klantenreviews, bestellijnen
        WHERE klantenreviews.bestellijnId = bestellijnen.bestellijnId AND artikelId = :id";

        $command = $dbh->prepare($sql);
        $command->execute(array(":id" => $id));

        $resultSet = $command->fetchAll(PDO::FETCH_ASSOC);
        $lijst = [];

        foreach($resultSet as $result){
            $review = new Review((int) $result["klantenReviewId"], $result["nickname"], (int) $result["score"],
            $result["commentaar"], $result["datum"], (int) $result["bestellijnId"]);
            //OPGELET: momenteel is de datum in een string formaat, geen datetime!!
            //Al proberen opzoeken hoe het vervormd moet worden maar niet meteen resultaat gevonden.

            array_push($lijst, $review);
        }

        $dbh = null;
        return $lijst;
    }
}