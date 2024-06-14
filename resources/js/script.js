let tabs = document.querySelectorAll(".tab");
let indicator = document.querySelector(".indicator");
let panels = document.querySelectorAll(".tab-panel");

indicator.style.width = tabs[0].getBoundingClientRect().width + "px";
indicator.style.left =
    tabs[0].getBoundingClientRect().left -
    tabs[0].parentElement.getBoundingClientRect().left +
    "px";

tabs.forEach((tab) => {
    tab.addEventListener("click", () => {
        let tabTarget = tab.getAttribute("aria-controls");

        indicator.style.width = tab.getBoundingClientRect().width + "px";
        indicator.style.left =
            tab.getBoundingClientRect().left -
            tab.parentElement.getBoundingClientRect().left +
            "px";

        panels.forEach((panel) => {
            let panelId = panel.getAttribute("id");
            if (tabTarget === panelId) {
                panel.classList.remove("invisible", "opacity-0");
                panel.classList.add("visible", "opacity-100");
            } else {
                panel.classList.add("invisible", "opacity-0");
            }
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const buttons = document.querySelectorAll(".section-button");
    buttons.forEach((button) => {
        button.addEventListener("click", function () {
            buttons.forEach((btn) => btn.classList.remove("selected"));
            this.classList.add("selected");
            filterSeats(this.dataset.section);
        });
    });

    // Trigger the click event on the default button to filter seats initially
    const defaultButton = document.querySelector(
        '.section-button[data-default="true"]'
    );
    if (defaultButton) {
        defaultButton.click();
    }
});

function filterSeats(section) {
    const seatItems = document.querySelectorAll(".seat-item");
    seatItems.forEach((item) => {
        if (item.dataset.section === section) {
            item.style.display = "block";
        } else {
            item.style.display = "none";
        }
    });
}
