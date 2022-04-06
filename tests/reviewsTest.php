<?php
//DEZE FILE MOET VERPLAATST WORDEN NAAR DE ROOT FOLDER OM TE WERKEN
//VOORLOPIG STAAT DEZE IN DE TEST FOLDER OM DE ROOT NIET VOL TE STOPPEN

require_once __DIR__ . "/../Business/ReviewService.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews test</title>
</head>
<body>
    <ul>
        <?php
            $reviewService = new ReviewService();
            $lijst = $reviewService->getAllReviews(33);
            foreach($lijst as $review) {
                print("<li>" . $review->getCommentaar() . "</li>");
            }
        ?>
    </ul>
</body>
</html>