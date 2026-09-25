let currentRow = String(1);
const guessForm = document.getElementById('guessForm');
const guessErrorMessage = document.getElementById('guessErrorMessage');
const guessErrorMessageAnchor = document.getElementById('guessErrorMessageAnchor');

let guessAsArray = [];

let word = '';

const words = [
    'poopoo', //0
    'peepee',
    'doiing',
    'blaarp',
    'fartsy',
    'apples',
    'eminem',
    'excise',
    'dihrea',
    'finger',
    'nylong', //10
    'bahrom',
]

let won = false

function randint(min, max) {
  return Math.floor(Math.random() * (max - min + 1)) + min;
}
word = words[randint(0, 11)]; //make sure to increas max alongside with the list of words
wordAsArray = [...word];


async function guess(event) {
    event.preventDefault();
    // checking if guess is even valid
    let guess = document.getElementById('guessInput').value
    if (!guess) {
        guessErrorMessage.textContent = 'where is your guess?';
        return;
    }else if (guess.length > 6) {
        guessErrorMessage.textContent = 'too many letters';
        return;
    }else if (guess.length ==5) {
        guessErrorMessage.textContent = 'this isnt wordle what are you doing (too less letters)'
        return;
    }else if (guess.length < 6) {
        guessErrorMessage.textContent = 'too less letters'
        return;
    }else {
        guessErrorMessage.textContent = 'good guess!'
    }
    guessAsArray = [...guess];
    guessResults = {};
    for (let i = 0; i < 6; i++) {
        guessResults[i] = 'grey';
    }
    lettersAlreadyChecked = [];
        
    if (guess == word) {
        won = true;
        guessResults[0] = "green";
        guessResults[1] = "green";
        guessResults[2] = "green";
        guessResults[3] = "green";
        guessResults[4] = "green";
        guessResults[5] = "green";
    }else {
        //determining the correctness of each letter
        // green letter
        for (let i = 0; i < 6; i++) {
            if (guessAsArray[i] == wordAsArray[i]) {
                guessResults[i] = "green";
                lettersAlreadyChecked.push(i); 
            }else {
                guessResults[i] = 'grey'
            }
        }
        //yellow letter
        for (let i = 0; i < 6; i++) { //can't use lettersAlreadyCheck.length as the already checked letters may be further in the word
            if (lettersAlreadyChecked.includes(i)) {
                continue; //skips this letter if it has already been checked
            }else if (wordAsArray.includes(guessAsArray[i])) {
                let index = wordAsArray.indexOf(guessAsArray[i]);
                if (lettersAlreadyChecked.includes(index)) {
                    continue;
                }else {
                    lettersAlreadyChecked.push(index);
                    guessResults[i] = "#c1ae33";
                }
            }else {
                guessResults[i] = 'grey';
            }
        //grey letters have already been set as grey through else statements, therefore there is no need for a for loop for grey letters.
        }
    }
    

    //displaying the letters on screen
    
    for (let i = 0; i < 6; i++) {
        let currentColumn = i + 1
        let coords = currentColumn + "," + currentRow;
        document.getElementById(coords).textContent = guessAsArray[i];
        document.getElementById(coords).style.background = guessResults[i];
    }
    currentRow = Number(currentRow) + 1;
    currentRow = String(currentRow);

    if (won == true) {
        guessErrorMessage.textContent = 'you won! congrats:D play again?'
        const response = await fetch('includes/wordley_won.inc.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    });
        const text = await response.text();

        if (!response.ok) {
            console.error('win saving to database failed. the win was not recorded, sorry for the inconvenience:(', response.status, text);
            return null;
        }else if (text){
            guessErrorMessage.textContent = text
        }
        return;
    }else if (currentRow >= 7) {
        guessErrorMessage.textContent = 'all guesses used. the word was: ' + word + '. play again?'
        return;
    }
    guessForm.reset();
    document.getElementById('guessInput').focus();
}

guessForm.addEventListener('submit', guess);