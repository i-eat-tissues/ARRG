const rarityColors = { //change in the future, ooo i wonder if i can make a gradient somehow SOMEHOWW
    common: "grey",
    uncommon: "blue",
    rare: "green",
    epic: "purple",
    legendary: "gold",
    unobtainable: "red"
};

document.querySelectorAll(".rarityIndicator").forEach((indicator) => {
    const rarity = indicator.textContent.replace(/^rarity:\s*/i, "").trim().toLowerCase();
    const color = rarityColors[rarity];

    if (color) {
        indicator.style.color = color;
    }
});