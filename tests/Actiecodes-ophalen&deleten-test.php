<?php
require_once __DIR__ . "/../Data/ActiecodesDAO.php";

$actiecodesDAO = new ActiecodesDAO();

$naamVoorOphaal = "Nieuwjaar";
$actiecode = $actiecodesDAO->getbyNaam($naamVoorOphaal);

//handmatig nieuwe code toevoegen in database alvorens test uit te voeren.
$naamVoorDelete = "Deletemij";
$actiecodesDAO->deleteByNaam($naamVoorDelete);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test voor delete en ophaal actiecode</title>
</head>
<body>
    <h2>Actiecode ophalen voor Nieuwjaar:</h2>
    <?php
        print_r($actiecode);
        if($actiecode->getIsEenmalig()) {
            print("<p>TRUE</p>");
        } else {
            print("<p>FALSE</p>");
        }
    ?>
</body>
</html>