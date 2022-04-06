"use strict";

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

document.querySelector('#apartLeverAdres').addEventListener('change', function(e) {
    document.getElementById('leveradresInput').classList.toggle('hide');
    document.querySelectorAll('#leveradres>input[text]').required=true;
});

document.querySelector('#rechtspersoon').addEventListener('change', function(e) {
    document.getElementById('rechtspersoonInput').classList.toggle('hide');
    document.querySelectorAll('#rechtspersoon>input[text]').required=true;
});