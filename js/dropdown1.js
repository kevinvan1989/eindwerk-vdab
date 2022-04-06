"use strict";
const hoofdcategorie = document.querySelectorAll(".hoofdcategorie");
window.addEventListener("load", function () {
  addEventListeners();
});

const urlParams = new URLSearchParams(window.location.search);
const pageSize = urlParams.get('categorieId');
console.log(pageSize);

const addEventListeners = () => {
  console.log("nie é moatje");
  for (let i = 0; i < hoofdcategorie.length; i++) {
    hoofdcategorie[i].parentElement.classList.add(i);
    hoofdcategorie[i].addEventListener("click", (e) => {
      const clickedElement = e.target;
      console.log(clickedElement)

      if (!clickedElement.classList.contains("selected")) {
        clearAll();
        clickedElement.classList.add("selected", i);
        hideSubMenu();
        showSubMenu(clickedElement);
      } else {
        hideSubMenu();
        e.target.classList.remove("selected");
      }
    });
  }
};

const clearAll = () => {
  hoofdcategorie.forEach((element) => {
    element.classList.remove("selected");
  });
};

const showSubMenu = (el) => {
  const parentElement = el.parentElement; // returns <li>
  console.log(parentElement);
  if (parentElement.querySelector("ul.lijst__subcategorieen") !== null) {
    const subItems = parentElement.querySelector("ul");
    console.log(subItems);
    subItems.classList.remove('hide');
    subItems.addEventListener('click', e => {
      const subSubList = e.target.querySelector('ul');
      console.log(subSubList)
      if(subSubList.classList.contains('hide')){
        subSubList.classList.remove('hide');
      }else{
        subSubList.classList.add('hide');
      }
      
    })
  }
};

const hideSubMenu = (el) => {
  const allSubcat = document.querySelectorAll(".lijst__subcategorieen");
  allSubcat.forEach((element) => {
    element.classList.add("hide");
  });

  const allSubSubcat = document.querySelectorAll(".lijst__sub__subcategorieen");
  allSubSubcat.forEach((element) => {
    element.classList.add("hide");
  });


};
