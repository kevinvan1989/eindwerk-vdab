<?php

declare(strict_types=1);

include_once __DIR__ . "/../Business/PlaatsService.php";

$plaatsService = new PlaatsService;

$plaatsen = $plaatsService->getPlaatsen();
?>
<form action="PlaatsSelectTestje.php" method="POST">
    <input list="plaatsen" id="fplaatsInput">
    <datalist id="plaatsen">
        <?php foreach ($plaatsen as $plaats) { ?>
            <option data-value="<?php echo $plaats->getPlaatsId() ?>"><?php echo $plaats->getPostcode() . " " . $plaats->getPlaats() ?></option>
        <?php } ?>
    </datalist>
    <input type="hidden" name="plaats" id="plaatsInput-hidden">
    <input type="submit" value="test!">
</form>

<?php if (isset($_POST['plaats'])){echo $_POST['plaats'];}?>
<script>
    document.querySelector('#plaatsInput').addEventListener('input', function(e) {
    var input = document.getElementById('plaatsInput'),
        options = document.querySelectorAll('option'),
        hiddenInput = document.getElementById('plaatsInput-hidden'),
        inputValue = input.value;
        hiddenInput.value = "";

    for(var i = 0; i < options.length; i++) {
        var option = options[i];

        if(option.innerText === inputValue) {
            hiddenInput.value = option.getAttribute('data-value');
            break;
        }
    }
});
</script>