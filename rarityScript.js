const rarityColors = { 
    common: "#03dffc",
    uncommon: "#0480de",
    rare: "#ab11ed",
    epic: "#db0980",
    legendary: "#dbb809",
    unobtainable: "#db8009"
};

document.querySelectorAll(".rock-card-rarity").forEach((indicator) => {
    const rarity = indicator.textContent.replace(/^rarity:\s*/i, "").trim().toLowerCase();
    const color = rarityColors[rarity];

    if (color) {
        indicator.style.color = color;
    }
});