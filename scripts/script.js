/*================
    Init Events
  ================*/

const defaultEvents = [
  { name: "Dance party", creator: "Markiesch", start: "12-5-2021 : 14:30", end: "12-5-2021 : 15:45", location: "'s-Hertogenbosch" },
  { name: "Pool party", creator: "Markiesch", start: "14-5-2021 : 18:00", end: "14-5-2021 : 23:30", location: "'s-Hertogenbosch" },
  { name: "Diner evening", creator: "Markiesch", start: "14-5-2021 : 16:45", end: "14-5-2021 : 19:30", location: "'s-Hertogenbosch" },
];

let events = JSON.parse(localStorage.getItem("events"));
if (!events || !events.length) localStorage.setItem("events", JSON.stringify(defaultEvents));

/*===================
    Lang management
  ===================*/
let lang = localStorage.getItem("lang") ?? "en";

const langBtn = document.querySelector(".lang");
langBtn.addEventListener("click", toggleLang);

function toggleLang() {
  lang = lang == "en" ? "nl" : "en";
  localStorage.setItem("lang", lang);

  loadLang();
}

function loadLang() {
  fetch("./scripts/lang.json")
    .then((response) => response.json())
    .then((data) => {
      const elements = document.querySelectorAll("[data-lang]");

      for (const element of elements) {
        const title = element.dataset.lang;
        element.innerHTML = data[lang][title];
      }
    });
}
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
