const params = new URLSearchParams(window.location.search);
const rock = params.get("rock");

/*
document.getElementById('name').textContent = "";
document.getElementById('rarity').textContent = "";

document.getElementById('rockImage').src = "";
document.getElementById('rockImage').alt = "";

document.getElementById('summary').textContent = "";

document.getElementById('rockSpawn').src = "";
document.getElementById('rockSpawn').alt = "";
document.getElementById('rockSpawnFigCap').textContent = "";
document.getElementById('rockSpawniframe').style.display = 'none';

OR

document.getElementById('rockSpawniframe').src = "";
document.getElementById('rockSpawnFigure').style.display = 'none';

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
    document.getElementById('rarity').textContent = "UNOBTAINABLE";

    document.getElementById('rockImage').src = "images/rock_info_images/harvey.png";
    document.getElementById('rockImage').alt = "Drawn image of Harvey";

    document.getElementById('summary').textContent = "Harvey is a special type of a piece of basalt, due to his non magnetic and heavy properties. He was first found on the 22nd of November, 2025.\nHe is the wearer of many hats, a black witch hat, a small red hat (similar to the one of Albert) and a medium sized blue hat.\nThese hats were all made by a professional seamstress, his owner.";

    document.getElementById('rockSpawniframe').src = "https://www.google.com/maps/embed?pb=!4v1790316676118!6m8!1m7!1snxp3JUbqvPN_GMRB_torKw!2m2!1d-36.88430575694727!2d174.7323219893889!3f201.85266059996852!4f-1.5665630356137399!5f0.7820865974627469";
    document.getElementById('rockSpawnFigure').style.display = 'none';

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

    document.getElementById('rockImage').src = "images/rock_info_images/albert.png";
    document.getElementById('rockImage').alt = "Drawn image of Albert";

    document.getElementById('summary').textContent = "Albert is believed to be a piece of concrete who has been missing since June 2026. He was found on the 22nd of November, 2025, at Wagner Place, Mount Albert, New Zealand\nHe has a bright red hat that was crafted by his loving owner on the 13th of December, 2025 using cardboard and acrylic paint.";

    document.getElementById('rockSpawniframe').src = "https://www.google.com/maps/embed?pb=!4v1790316676118!6m8!1m7!1snxp3JUbqvPN_GMRB_torKw!2m2!1d-36.88430575694727!2d174.7323219893889!3f201.85266059996852!4f-1.5665630356137399!5f0.7820865974627469";
    document.getElementById('rockSpawnFigure').style.display = 'none';

    document.getElementById('description').textContent = "Albert is most likely a piece of concrete, which is considered a man-made rock. He inhibits a rough, sandy surface with little crushed up bits of rock. He likely chipped off a little bit of the curb, which is how scientists think he was created.\nHe has a smiling face drawn on him, often referred to as a C: due to his large smile. His face was drawn with a sharpie.\nHis name, contrary to popular belief, was heavily inspired by theoretical physicist Albert Einstein. He was not named after the mountain Mount Albert, or the suburb Mount Albert.";

    document.getElementById('extraRockImage').src = "images/rock_info_images/albertExtraImage.jpg";
    document.getElementById('extraRockImage').alt = "An image of Albert Einstein poking his tongue out.";
    document.getElementById('extraRockImageFigCap').textContent = "Source: Wikipedia. a silly picture of Albert Einstein";

    document.getElementById('source1').textContent = "https://arrg.gt.tc/profile.php?username=re35n";
    document.getElementById('source1').href = "profile.php?username=re35n";

} else if (rock === 'basalt') {
    document.getElementById('name').textContent = "basalt";
    document.getElementById('rarity').textContent = "COMMON";

    document.getElementById('rockImage').src = "images/rock_info_images/basalt.png";
    document.getElementById('rockImage').alt = "Drawn image of a basalt.";

    document.getElementById('summary').textContent = "Basalt is an igneous rock, formed in volcanic eruptions. It is magnesium and iron rich, and very common, making up 90% of the world’s volcanic rock population.";

    document.getElementById('rockSpawn').src = "images/rock_info_images/basaltSpawn.png";
    document.getElementById('rockSpawn').alt = "an image of micronesia, melanesia, and polnesia.";
    document.getElementById('rockSpawnFigCap').textContent = "a map of some pacific islands. source: wikimedia commons";
    document.getElementById('rockSpawniframe').style.display = 'none';

    document.getElementById('description').textContent = "Basalt is primarily composed of silicon, iron, magnesium, potassium, aluminium, titanium, and calcium. This is due to its volcanic properties, as it originates from basalt magma, which erupts from approximately only 20 volcanoes each year.\nBasalt is very common however! It can be found on The Moon, Venus, Mars, Vesta (one of the largest asteroids in the asteroid belt), and Io, the second smallest of the four galilean moons of Jupiter.\nBasalt is commonly used in construction (sometimes used in concrete!) and to create statues. This is mainly taking advantage of not only its commonness but also its hardness!\nthe word ‘basalt’ comes from a later latin word ‘basaltes’ which was actually a misspelling of a latin word ‘basanites’ which literally meant very hard rock, which makes sense as basalt is rated a 6-7 on the mohs scale (no I’m NOT joking search it up) which is relatively hard, compared to diamond at a rating of 10.";

    document.getElementById('extraRockImage').src = "images/rock_info_images/basaltExtraImage.jpg";
    document.getElementById('extraRockImage').alt = "image of a piece of basalt.";
    document.getElementById('extraRockImageFigCap').textContent = "image of basalt. source: wikimedia commons";

    document.getElementById('source1').textContent = "https://en.wikipedia.org/wiki/Basalt";
    document.getElementById('source2').textContent = "https://en.wikipedia.org/wiki/Io_(moon)";
    document.getElementById('source3').textContent = "https://en.wikipedia.org/wiki/4_Vesta";

    document.getElementById('source1').href = "https://en.wikipedia.org/wiki/Basalt";
    document.getElementById('source2').href = "https://en.wikipedia.org/wiki/Io_(moon)";
    document.getElementById('source3').href = "https://en.wikipedia.org/wiki/4_Vesta";
}