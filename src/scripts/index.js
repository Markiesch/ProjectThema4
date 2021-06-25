/*
    Author: Mark Schuurmans
    Date: 29-5-2021
    File: scripts/animation.js

    Project Thema 4    
*/

const elements = document.querySelectorAll(".animate");
document.addEventListener("mousemove", (e) => {
    // Krijgt de x en y positie van de gebruiker zijn muis (in pixels)
    const left = e.clientX;
    const top = e.clientY;

    // Loopt over alle items in de elements array heen met als "placeholder" waarde "element"
    for (const element of elements) {
        const speed = element.dataset.speed;
        element.style.setProperty("--translateX", `-${(left / 30) * speed}px`);
        element.style.setProperty("--translateY", `-${(top / 20) * speed}px`);
    }
});

const imgContainer = document.querySelector(".image--container > div");
const trigger = document.querySelector(".bolt");
// Een variable om bij te houden of de animatie al bezig is
let animating = false;

trigger.addEventListener("click", () => {
    if (animating) return;
    animating = true;
    imgContainer.classList.add("animating");

    setTimeout(() => {
        imgContainer.classList.remove("animating");
        animating = false;
        // Voert de bovenstaande code pas na 2000ms uit (2 seconden)
    }, 2000);
});

const images = 4;
const image = imgContainer.querySelector("img");
const number = Math.floor(Math.random() * images) + 1;
if (number == 3) image.classList.add("reverse");
image.src = `/ProjectThema4/src/images/bg${number}.png`;
