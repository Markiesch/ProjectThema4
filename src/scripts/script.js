/*
    Author: Mark Schuurmans
    Date: 29-5-2021
    File: scripts/script.js

    Project Thema 4    


  ===================
    Lang management
  ===================*/
let lang = "nl";

// Zet de lang variabel naar de gene die opgeslagen is in localstorage als deze bestaat
if (localStorage.getItem("lang") !== null) {
    lang = localStorage.getItem("lang");
}

const langBtn = document.querySelector(".lang");
langBtn.addEventListener("click", toggleLang);

function toggleLang() {
    // Zet de lang variabel naar NL als het op EN staat (true) en zet het naar EN als het niet op EN staat (NL, false)
    lang = lang == "en" ? "nl" : "en";
    localStorage.setItem("lang", lang);

    loadLang();
}

function loadLang() {
    fetch("/src/scripts/lang.json")
        .then((response) => response.json())
        .then((data) => {
            // Selecteerd alle elementen met een data-lang attribuut
            const elements = document.querySelectorAll("[data-lang]");

            // Loopts over alle elementen met als "placeholder" "element"
            for (const element of elements) {
                // Krijgt de waarde van de data-lang attribuut
                const title = element.dataset.lang;
                // data is geen array maar een object de [] zorgen ervoor dat hij de waarde van de variable leest ipv als woord
                element.innerHTML = data[lang][title];
            }
        });
}
// Laad de teksten in wanneer de pagina laad
loadLang();

/*=============
    Scrollbar
  =============*/
window.onload = () => {
    const progressEl = document.querySelector(".progressbar");
    window.onscroll = function updateScroll() {
        const totalHeight = document.body.scrollHeight - window.innerHeight;
        const progressHeigth = (window.pageYOffset / totalHeight) * 100;
        progressEl.style.height = progressHeigth + "%";
    };
};

function updateColor() {
    const root = document.querySelector(":root");
    const color = localStorage.getItem("color") || "hsl(359, 90%, 62%)";
    root.style.setProperty("--primary-color", color);
}

updateColor();
