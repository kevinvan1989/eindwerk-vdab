// Toggle winkelmandje of loginpopup
// Sluit pop up bij klik buiten kader
const inlogFormSelector = document.querySelector("#inlogForm");
const winkelmandjePopupSelector = document.querySelector("#winkelmandje");
const zijbalkSelector = document.querySelector("#boom");

document.addEventListener("click", (e) => {
  // Klik op de gebruiker knop
  if (
    e.target.closest("#login-header") &&
    inlogFormSelector.classList.contains("hide")
  ) {
    console.log(document.querySelector("#inlogForm"));
    inlogFormSelector.classList.remove("hide");
    document.querySelector("#inlogForm input#emailadres").select();
  } else if ( // Klik buiten de popup : op de knop, in het venster, ....
    !e.target.closest("#inlogForm") &&
    !inlogFormSelector.classList.contains("hide")
  ) {
    inlogFormSelector.classList.add("hide");
    console.log(document.querySelector("#inlogForm input#emailadres"));
    document.querySelector("#inlogForm input#emailadres").value = "";
  }

   // Klik op de winkelmand knop
  if (
    e.target.closest("#mandje") &&
    winkelmandjePopupSelector.classList.contains("hide")
  ) {
    console.log(document.querySelector("#winkelmandje"));
    winkelmandjePopupSelector.classList.remove("hide");
  } else if ( // Klik buiten de popup : op de knop, in het venster, ....
    !e.target.closest("#winkelmandje") &&
    !winkelmandjePopupSelector.classList.contains("hide")
  ) {
    winkelmandjePopupSelector.classList.add("hide");
  }

  //klik op hamburger knop
  if (
    e.target.closest("#hamburger") &&
    zijbalkSelector.classList.contains("hide--mobile")
  ) {
    zijbalkSelector.classList.remove("hide--mobile");
    window.scrollTo(0,85);
  } else if ( // Klik buiten de popup : op de knop, in het venster, ....
    !zijbalkSelector.classList.contains("hide--mobile")
  ) {
    zijbalkSelector.classList.add("hide--mobile");
    window.scrollTo(0,0);
  }

});


// houdt menu in positie als zijbalk open is in mobile
document.addEventListener("scroll", (e) => {
  if (!zijbalkSelector.classList.contains("hide--mobile")){
    window.scrollTo(0,85);
  }
});

// ----- COOKIE MELDING ------
// Functionaliteit om pop-up te sluiten
const closeIcon = document.getElementById("close-icon");
const closeButton = document.getElementById("cookie");

closeIcon?.addEventListener("click", (e) => {
  removePopup(e.target);
});
closeButton?.addEventListener("click", (e) => {
  removePopup(e.target);
});

const removePopup = (e) => {
  e.parentNode.parentNode.removeChild(e.parentElement);
};


//errormelding
document.getElementById("errorWeg").addEventListener("click", function (elem) {
  elem.preventDefault();
  document.getElementById("error").hidden = true;
});

