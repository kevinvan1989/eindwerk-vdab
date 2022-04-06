"use strict";

document.getElementById('PWWijzigen').addEventListener("click", (elem) => {
    elem.preventDefault();
    if (document.getElementById('PWBox').classList.contains("hide")){
        document.getElementById('PWWijzigen').innerText = "Profielgegevens wijzigen";
    }else{
        document.getElementById('PWWijzigen').innerText = "Wachtwoord wijzigen";
    }
    document.getElementById('PWBox').classList.toggle('hide');
    document.getElementById('mainForm').classList.toggle('hide');
    
});

document.querySelector('#facturatiePlaatsInput').addEventListener('input', function(e) {
    var input = document.getElementById('facturatiePlaatsInput'),
        options = document.querySelectorAll('option'),
        hiddenInput = document.getElementById('facturatiePlaatsInput-hidden'),
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

document.querySelector('#leverPlaatsInput').addEventListener('input', function(e) {
    var input = document.getElementById('leverPlaatsInput'),
        options = document.querySelectorAll('option'),
        hiddenInput = document.getElementById('leverPlaatsInput-hidden'),
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