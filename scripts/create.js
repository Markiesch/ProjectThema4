const form = document.querySelector("form");
const nameEl = document.querySelector("#name");
const startDateEl = document.querySelector("#startDate");
const endDateEl = document.querySelector("#endDate");
const locationEl = document.querySelector("#location");

const successDialog = document.querySelector(".success");
const errorDialog = document.querySelector(".error");

form.addEventListener("submit", (event) => {
  try {
    event.preventDefault();
    form.classList.add("hidden");
    const events = JSON.parse(localStorage.getItem("events") ?? "[]");
    events.push({
      name: nameEl.value,
      creator: "administrator",
      start: startDateEl.value,
      end: endDateEl.value,
      location: locationEl.value,
    });

    localStorage.setItem("events", JSON.stringify(events));
    successDialog.classList.remove("hidden");
  } catch (error) {
    errorDialog.classList.remove("hidden");
  }
});
