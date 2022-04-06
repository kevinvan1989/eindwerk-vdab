<?php
declare(strict_types = 1);

require_once __DIR__ . "/../Business/ActiecodeService.php";

$actiecodeService = new ActiecodeService();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test ActiecodeService</title>
</head>
<body>
    <h2>Eerste test (geldige code):</h2>
    <?php
    $actiecodeGeldig = $actiecodeService->getByNaam("test");
    print("<p>" . $actiecodeGeldig->getNaam() . "</p>");
    ?>

    <h2>Tweede test (ongeldige code):</h2>
    <?php
    $actiecodeOngeldig = $actiecodeService->getByNaam("Nieuwjaar");
    print("<p>" . $actiecodeOngeldig->getNaam() . "</p>");
    ?>
</body>
</html>