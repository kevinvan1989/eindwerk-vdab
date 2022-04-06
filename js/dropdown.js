"use strict";
window.addEventListener("load", function () {
  // Submenu blijft open als er producten geselecteerd zijn uit die categorie
  for (
    let i = 0;
    i < this.document.querySelectorAll("span.categorie").length;
    i++
  ) {
    this.document
      .querySelectorAll("span.categorie")
      [i].addEventListener("click", (e) => {
        console.log();
        e.target.nextElementSibling.classList.toggle("hide");
      });
    }

    if (this.window.location.search.includes("categorieId")) {
      const posStartId = window.location.search.indexOf("=") + 1;
      const categorieId = window.location.search.slice(posStartId);
      this.sessionStorage.setItem("id", categorieId);
      const el = document.querySelector(
        "[href='index.php?categorieId=" + categorieId + "']"
      );
      el.classList.add("selected");
      el.parentElement.parentElement.parentElement.classList.remove("hide");
    }

    if (this.window.location.href.includes("productPagina.php")) {
      // Mark up van de nav obv categorie-id in sessionstorage
      const el = document.querySelector(
        "[href='index.php?categorieId=" +
          this.sessionStorage.getItem("id") +
          "']"
      );
      el.classList.add("selected");
      // Gebruik de inhoud van session storage en maak daarna leeg
      el.parentElement.parentElement.parentElement.classList.remove("hide");
    }

    // Clear session
    if (this.window.location.href.endsWith("index.php")) {
      if (this.sessionStorage.getItem("id")) {
        this.sessionStorage.clear();
      }
    }
  
});
