<?php require_once __DIR__ . "/../Business/PlaatsService.php";$plaatsserv = new PlaatsService;$plaatsenLijst = $plaatsserv->getPlaatsen();?> 
<!DOCTYPE html>
<html lang="nl">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- CSS hier weglaten achteraf? -->
  <link href="../css/style.css" rel="stylesheet" type='text/css'> 

<body>
    <div class="col-2 rechterkolom">
        <h2><?php echo "Plaats"?></h2>
        <input type="text" id="zoekplaats" onkeyup="filterTabel()" placeholder="Zoek plaats.." title="Geef een naam in">
        <table id="plaatsenTabel">
            <tr class="header">
                <th style="width:70%;">Plaatsnaam</th>
                <th style="width:30%;">Postcode</th>
            </tr>
            <?php foreach ($plaatsenLijst as $plaats) { $optie=' href="selectedplaats.php?' . $plaats->getPlaats() . '"' ?>
<!--                <?php echo "<tr><td>" . $plaats->getPlaats() . "</td><td>" . $plaats->getPostcode() . "</td></tr>" ?> -->
                <?php echo "<tr><td><a " . $optie . "> " . $plaats->getPlaats() . "</a></td><td>" . $plaats->getPostcode() . "</td></tr>" ?>
                <a href="/artikel/artikel.php?artid=456">
            <?php } ?>
        </table>
    </div>
    <script>
    function filterTabel() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("zoekplaats");
        filter = input.value.toUpperCase();
        table = document.getElementById("plaatsenTabel");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
            }       
        }
    }
    </script>
<a href="javascript:alert('Hello World!');">Execute JavaScript</a>
</body>
</html>
