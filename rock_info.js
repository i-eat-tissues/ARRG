const params = new URLSearchParams(window.location.search);
const rock = params.get("rock");

/*
document.getElementById('name').textContent = "";
document.getElementById('rarity').textContent = "";
document.getElementById('id').textContent = "";

document.getElementById('rockImage').src = "";
document.getElementById('rockImage').alt = "";

document.getElementById('summary').textContent = "";

document.getElementById('rockSpawn').src = "";
document.getElementById('rockSpawn').alt = "";
document.getElementById('rockSpawnFigCap').textContent = "";

document.getElementById('description').textContent = "";

document.getElementById('extraRockImage').src = "";
document.getElementById('extraRockImage').alt = "";
document.getElementById('extraRockImageFigCap').textContent = "";

document.getElementById('source1').textContent = "";
document.getElementById('source2').textContent = "";
document.getElementById('source3').textContent = "";

document.getElementById('source1').href = "";
document.getElementById('source2').href = "";
document.getElementById('source3').href = "";
*/ 

console.log(rock);

if (rock === "harvey") {
    document.getElementById('name').textContent = "harvey";
    document.getElementById('rarity').textContent = "1";
    document.getElementById('id').textContent = "UNOBTAINABLE";

    document.getElementById('rockImage').src = "images/harvey.jpg";
    document.getElementById('rockImage').alt = "Drawn image of Harvey";

    document.getElementById('summary').textContent = "Harvey is a special type of a piece of basalt, due to his non magnetic and heavy properties. He was first found on the 22nd of November, 2025.\nHe is the wearer of many hats, a black witch hat, a small red hat (similar to the one of Albert) and a medium sized blue hat.\nThese hats were all made by a professional seamstress, his owner.";

    document.getElementById('rockSpawn').src = "images/rock_info_images/harveySpawn.png";
    document.getElementById('rockSpawn').alt = "An image of where the one and only Harvey was found in this world.";
    document.getElementById('rockSpawnFigCap').textContent = "Source: Google Maps. Harvey spawn location";

    document.getElementById('description').textContent = "Harvey is believed to be a piece of basalt, due to his high density (making him rather heavy) and his black-grey colouring. Basalt is an igneous volcanic rock that forms when molten lava cools quickly on the Earth's surface.\nHarvey is also believed to be a piece of basalt because he was found near Mount Albert, which is an extinct scoria cone volcano that erupted 120,000 years ago, likely forming Harvey and his brothers and sisters. He may have also been formed by another volcano in Auckland, and tumbled his way to mount albert, as Harvey was found in the Auckland volcanic field.";

    document.getElementById('extraRockImage').src = "images/rock_info_images/harveyExtraImage.jpg";
    document.getElementById('extraRockImage').alt = "An image of the Auckland volcanic field labelling all 53 volcanoes in it.";
    document.getElementById('extraRockImageFigCap').textContent = "Auckland volcanic field, where Harvey was found. Source: Wikipedia.";

    document.getElementById('source1').textContent = "https://en.wikipedia.org/wiki/\u014Cwairaka_/_Mount_Albert";
    document.getElementById('source2').textContent = "https://en.wikipedia.org/wiki/Auckland_volcanic_field";
    document.getElementById('source3').textContent = "https://en.wikipedia.org/wiki/Basalt";

    document.getElementById('source1').href = "https://en.wikipedia.org/wiki/\u014Cwairaka_/_Mount_Albert";
    document.getElementById('source2').href = "https://en.wikipedia.org/wiki/Auckland_volcanic_field";
    document.getElementById('source3').href = "https://en.wikipedia.org/wiki/Basalt";

} else if (rock === "albert") {
    document.getElementById('name').textContent = "albert";
    document.getElementById('rarity').textContent = "UNOBTAINABLE";
    document.getElementById('id').textContent = "2";

    document.getElementById('rockImage').src = "images/albert.jpg";
    document.getElementById('rockImage').alt = "Drawn image of Albert";

    document.getElementById('summary').textContent = "Albert is believed to be a piece of concrete who has been missing since June 2026. He was found on the 22nd of November, 2025, at Wagner Place, Mount Albert, New Zealand\nHe has a bright red hat that was crafted by his loving owner on the 13th of December, 2025 using cardboard and acrylic paint.";

    document.getElementById('rockSpawn').src = "images/rock_info_images/albertSpawn.png";
    document.getElementById('rockSpawn').alt = "An image of where the one and only Albert was found in this world.";
    document.getElementById('rockSpawnFigCap').textContent = "Source: Google Maps. Albert spawn location";

    document.getElementById('description').textContent = "Albert is most likely a piece of concrete, which is considered a man-made rock. He inhibits a rough, sandy surface with little crushed up bits of rock. He likely chipped off a little bit of the curb, which is how scientists think he was created.\nHe has a smiling face drawn on him, often referred to as a C: due to his large smile. His face was drawn with a sharpie.\nHis name, contrary to popular belief, was heavily inspired by theoretical physicist Albert Einstein. He was not named after the mountain Mount Albert, or the suburb Mount Albert.";

    document.getElementById('extraRockImage').src = "images/rock_info_images/albertExtraImage.jpg";
    document.getElementById('extraRockImage').alt = "An image of Albert Einstein poking his tongue out.";
    document.getElementById('extraRockImageFigCap').textContent = "Source: Wikipedia. a silly picture of Albert Einstein";

}