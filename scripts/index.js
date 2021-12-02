const elements = document.querySelectorAll(".animate");
document.addEventListener("mousemove", (e) => {
  const left = e.clientX;
  const top = e.clientY;

  for (const element of elements) {
    const speed = element.dataset.speed;
    element.style.setProperty("--translateX", `-${(left / 30) * speed}px`);
    element.style.setProperty("--translateY", `-${(top / 20) * speed}px`);
  }
});

const imgContainer = document.querySelector(".image--container > div");
const trigger = document.querySelector(".bolt");
let animating = false;

trigger.addEventListener("click", () => {
  if (animating) return;
  animating = true;
  imgContainer.classList.add("animating");

  setTimeout(() => {
    imgContainer.classList.remove("animating");
    animating = false;
  }, 2000);
});

const images = 4;
const image = imgContainer.querySelector("img");
const number = Math.floor(Math.random() * images) + 1;
if (number == 3) image.classList.add("reverse");
image.src = `images/bg${number}.png`;
