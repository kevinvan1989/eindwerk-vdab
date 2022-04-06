<?php
declare(strict_types = 1);

require_once __DIR__ . "/../Data/ReviewsDAO.php";

class ReviewService {
    //Haal alle reviews op van 1 product (parameter = artikelId)
    public function getAllReviews(int $id) : array {
        $reviewsDAO = new ReviewsDAO();
        $lijst = $reviewsDAO->getAll($id);
        return $lijst;
    }
}