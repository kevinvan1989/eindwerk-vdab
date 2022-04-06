<?php
require_once __DIR__ . "/../Data/BestellingenDAO.php";

$bestellingenDAO = new BestellingenDAO();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test status</title>
</head>
<body>
    <h2>
    <?php
    echo($bestellingenDAO->getBestelstatusById(1));
    ?>
    </h2>
</body>
</html>