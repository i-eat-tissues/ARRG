const rerollButton = document.getElementById("reroll");
const rockMessage = document.getElementById("rockMessage");
const unlocked = document.getElementById("unlocked");

let rarity;
let rockId;

function randint(min, max) {
  return Math.floor(Math.random() * (max - min + 1)) + min;
}

async function getRock() {
    rarity = randint(1, 256);
    if (rarity <= 128) {
        rockId = randint(3, 8);
    } else if (rarity <= 192) {
        rockId = randint(9, 14);
    } else if (rarity <= 224 && rarity > 192) {
        rockId = randint(15, 18);
    } else if (rarity <= 248 && rarity > 224) {
        rockId = randint(19, 20);
    } else if (rarity <= 256 && rarity > 248) {
        rockId = randint(21, 22);
    }
    const response = await fetch(`includes/get_rock.inc.php?rockId=${encodeURIComponent(rockId)}`);
    const rock = await response.json();

    if (rock.error) {
        rockMessage.textContent = rock.error;
        return;
    }

    rockMessage.textContent = "you got a " + rock.rockName;
    await sendRock(rock.rockName, rockId);
}

async function sendRock(rockName, rockId) {
    const response = await fetch(`includes/rolling.inc.php?rock=${encodeURIComponent(rockName)}&rockId=${encodeURIComponent(rockId)}`);
    const result = await response.json();

    if (result.error) {
        unlocked.textContent = "you are not logged in. please log in or sign up."
        return;
    }

    if (result.newRock === true) {
        unlocked.textContent = "new rock unlocked!";
    }else if (result.newRock === false) {
        unlocked.textContent = "rock already unlocked!";
    }else if (result.newRock === null) {
        unlocked.textContent = "result.newRock returned null? weird.";
    }else{
        unlocked.textContent = "WHAT"+ result.newRock;
    }
}

rerollButton.addEventListener("click", getRock);
