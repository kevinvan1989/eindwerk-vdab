"use strict";

let minBtn = document.getElementById("verminderMet1");
let plusBtn = document.getElementById("verhoogMet1");
let aantal = document.getElementById("aantalTeBestellen").value;

minBtn.addEventListener("click", verminderAantal);
plusBtn.addEventListener("click", verhoogAantal);

function verminderAantal() {
    if(aantal > 1) {
        aantal--;
    }
    document.getElementById("aantalTeBestellen").setAttribute('value', aantal);
    console.log(aantal);
}
function verhoogAantal() {
    if(aantal < 10) {
        aantal++;
    }
    document.getElementById("aantalTeBestellen").setAttribute('value', aantal);
    console.log(aantal);
}