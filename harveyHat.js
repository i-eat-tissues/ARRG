document.querySelectorAll(".hchangeHatToHarveyBlue").forEach(button => {
    button.addEventListener("click", () => {
        const figure = button.closest("figure");
        const img = figure.querySelector(".rockImage");

        img.src = "images/harveyHARVEYBLUEHAT.jpg";
    });
});
document.querySelectorAll(".hchangeHatAlbertRed").forEach(button => {
    button.addEventListener("click", () => {
        const figure = button.closest("figure");
        const img = figure.querySelector(".rockImage");

        img.src = "images/harveyALBERTREDHAT.jpg";
    });
});
document.querySelectorAll(".hchangeHatHarveyRed").forEach(button => {
    button.addEventListener("click", () => {
        const figure = button.closest("figure");
        const img = figure.querySelector(".rockImage");

        img.src = "images/harveyHARVEYREDHAT.jpg";
    });
});
document.querySelectorAll(".hchangeHatRemoveHat").forEach(button => {
    button.addEventListener("click", () => {
        const figure = button.closest("figure");
        const img = figure.querySelector(".rockImage");

        img.src = "images/harvey.jpg";
    });
});

