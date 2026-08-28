const rockButton = document.querySelectorAll('.countryRock');

const sleep = (ms) => new Promise((resolve) => setTimeout(resolve, ms));

for (let i = 0; i < rockButton.length; i++) {
    const button = rockButton[i];
    const image = button.querySelector(".countryRockImage");

    rockButton[i].addEventListener("click", async () => {
        button.disabled = true; 
        image.style.transform = "scaleY(0.9)";
        await sleep(250);
        image.style.transform = "scaleY(1)";
        button.disabled = false; 
    });
}

