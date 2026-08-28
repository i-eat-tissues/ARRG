
async function checkValidity(event) {
    event.preventDefault();
    const form = event.currentTarget; // get the form that caused this event (signup form)

    //defintes the variables we're getting the inputs from, and the error message element.
    const usernameInput = document.getElementById("usernameInput");
    const passwordInput = document.getElementById("passwordInput");
    const errorMessage = document.getElementById("errorMessage");

    const usernameCheck = usernameInput.value;
    const passwordCheck = passwordInput.value;

    //resets everything
    errorMessage.textContent = "";
    errorMessage.style.display = "none";
    let usernameValidity = false;
    let passwordValidity = false;
    let usernameValid = false;

    if (!usernameCheck) {
        errorMessage.textContent = "Please enter a username";
        usernameInput.style.borderColor = "red";
        errorMessage.style.display = "block";
    } else if (/[^a-zA-Z ]/.test(usernameCheck)) {
        errorMessage.textContent = "Username must not contain any symbols or numbers";
        usernameInput.style.borderColor = "red";
        errorMessage.style.display = "block";
    } else if (usernameCheck.length < 3) {
        errorMessage.textContent = "Username must be at least 3 characters";
        usernameInput.style.borderColor = "red";
        errorMessage.style.display = "block";
    } else {
        usernameValid = await isUsernameOriginal(usernameCheck);
        if (usernameValid === false) {
        errorMessage.textContent = "you aren't cool enough to have that username, try another one. (username taken)";
        usernameInput.style.borderColor = "red";
        errorMessage.style.display = "block";
        return;
        }
        if (usernameValid === null) {
            errorMessage.textContent = "Unable to validate username. this is probably not your fault, please try again.";
            usernameInput.style.borderColor = "red";
            errorMessage.style.display = "block";
            return;
        } else {
            errorMessage.textContent = "Great! Username is available:D";
            usernameValidity = true;
            usernameInput.style.borderColor = "#e3d8ca";
        }
    }

    if (!passwordCheck) {
        errorMessage.textContent = "Please enter a password";
        passwordInput.style.borderColor = "red";
        errorMessage.style.display = "block";
    } else if (passwordCheck.length < 8) {
        errorMessage.textContent = "Password must be at least 8 characters";
        passwordInput.style.borderColor = "red";
        errorMessage.style.display = "block";
    } else {
        passwordValidity = true;
        passwordInput.style.borderColor = "#e3d8ca";
    }

    console.log('checkValidity', {
        usernameCheck,
        passwordCheck,
        usernameValid,
        usernameValidity,
        passwordValidity,
    });

    if (!usernameValidity || !passwordValidity) {
        return;
    }

    errorMessage.textContent = "";
    errorMessage.style.display = "none";
    console.log('checkValidity: submitting form');
    form.submit();
}

async function isUsernameOriginal(username) {
    try {
        const response = await fetch(`includes/check_username.inc.php?username=${encodeURIComponent(username)}`);
        const text = await response.text();

        if (!response.ok) {
            console.error('Username validation request failed', response.status, text);
            return null;
        }

        let data;
        try {
            data = JSON.parse(text);
        } catch (parseError) {
            console.error('Username validation response invalid JSON', parseError, text);
            return null;
        }

        if (!data || typeof data.usernameTaken !== 'boolean') {
            console.error('Username validation response invalid', data);
            return null;
        }

        return data.usernameTaken !== true;
    } catch (error) {
        console.error('Username validation request error', error);
        return null;
    }
}

document.querySelector('form').addEventListener('submit', checkValidity);
