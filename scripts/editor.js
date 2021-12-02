// Aanspreken DOM elementen
const tabs = document.querySelectorAll(".tab");
const buttons = document.querySelectorAll("[data-tab]");

for (const button of buttons) {
  button.addEventListener("click", () => {
    // Callt de changetab functie met als parameter de value die in de data-tab attribute staat
    changeTab(button.dataset.tab);
  });
}

function changeTab(buttonData) {
  const button = document.querySelector(`[data-tab=${buttonData}]`);
  const tabName = button.dataset.tab;

  for (const tab of tabs) tab.classList.remove("active");
  document.querySelector(`.tab-${tabName}`).classList.add("active");

  for (const button of buttons) button.classList.remove("activeBtn");
  button.classList.add("activeBtn");

  // Slaat de data op in sessionStorage (nodig om op dezelfde tab te blijven op reload en form submit)
  sessionStorage.setItem("tab", tabName);
}

// Zet de variable naar de sessionstorage tab als deze niet NULL of UNDEFINED is anders pakt hij "Dashboard"
const startTab = sessionStorage.getItem("tab") || "dashboard";
changeTab(startTab);

const canvasEl = document.getElementById("colorCanvas");
// Nodig om dingen te veranderen op de canvas
const ctx = canvasEl.getContext("2d");

function initColorPicker() {
  const image = new Image(150, 150);
  // Wacht tot de afbeelding geladen is totdat we het kunnen toevoegen aan de canvas
  image.onload = () => ctx.drawImage(image, 0, 0, image.width, image.height);
  // Zet de source van de afbeelding
  image.src = "../images/ColorWheel.png";

  canvasEl.onclick = function (e) {
    // Krijgt de imagedata op de plek waar je klikt op een radius van 1 bij 1px
    const imgData = ctx.getImageData(e.offsetX, e.offsetY, 1, 1);
    const data = imgData.data;

    const rgb = `rgb(${data[0]}, ${data[1]}, ${data[2]})`;
    localStorage.setItem("color", rgb);
    // Nodig om de veranderingen te kunnen zien zonder te herladen (deze functie is te vinden in script.js)
    updateColor();
  };
}
initColorPicker();

function resetColor() {
  localStorage.removeItem("color");
  updateColor();
}

function setAvatar(avatar) {
  localStorage.setItem("avatar", avatar);
  // Nodig om de veranderingen te kunnen zien zonder te herladen
  loadAvatar();
}

const avatarEl = document.querySelector(".avatar");
function loadAvatar() {
  const avatarId = localStorage.getItem("avatar") ?? 1;
  avatarEl.src = `../images/avatars/avatar${avatarId}.png`;

  const avatarsEls = document.querySelectorAll(".avatar-wrapper img");
  // Verwijderd alle active classes
  for (const avatarsEl of avatarsEls) avatarsEl.classList.remove("active");

  const avatarSelectEl = document.querySelector(`.avatar${avatarId}`);
  avatarSelectEl.classList.add("active");
}
loadAvatar();

const langEl = document.querySelector(".current-lang");
langBtn.addEventListener("click", updateLang);

function updateLang() {
  const lang = localStorage.getItem("lang");
  langEl.innerHTML = lang.toUpperCase();
}
updateLang();
