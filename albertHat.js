document.querySelectorAll(".achangeHatToHarveyBlue").forEach(button => {
    button.addEventListener("click", () => {
        const figure = button.closest("figure");
        const img = figure.querySelector(".rockImage");

        img.src = "images/albertHARVEYBLUEHAT.jpg";
    });
});
document.querySelectorAll(".achangeHatAlbertRed").forEach(button => {
    button.addEventListener("click", () => {
        const figure = button.closest("figure");
        const img = figure.querySelector(".rockImage");

        img.src = "images/albertALBERTREDHAT.jpg";
    });
});
document.querySelectorAll(".achangeHatHarveyRed").forEach(button => {
    button.addEventListener("click", () => {
        const figure = button.closest("figure");
        const img = figure.querySelector(".rockImage");

        img.src = "images/albertHARVEYREDHAT.jpg";
    });
});
document.querySelectorAll(".achangeHatRemoveHat").forEach(button => {
    button.addEventListener("click", () => {
        const figure = button.closest("figure");
        const img = figure.querySelector(".rockImage");

        img.src = "images/albert.jpg";
    });
});

