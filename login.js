
async function checkValidity(event) {
    event.preventDefault();
    const form = event.currentTarget; // get the form that caused this event (signup form)

    //defintes the variables we're getting the inputs from, and the error message element.
    const usernameInput = document.getElementById("usernameInput");
    const passwordInput = document.getElementById("pwdInput");
    const errorMessage = document.getElementById("errorMessage");

    const usernameCheck = usernameInput.value;
    const passwordCheck = passwordInput.value;

    //resets everything
    errorMessage.textContent = "";
    errorMessage.style.display = "none";
    let usernameValidity = false;
    let passwordValidity = false;
    let usernameFound = true;

    if (!usernameCheck) {
        errorMessage.textContent = "Please enter a username";
        usernameInput.style.borderColor = "red";
        errorMessage.style.display = "block";
        return;
    } else {
        usernameFound = await isUsernameInDB(usernameCheck);
        if (usernameFound === false) {
        errorMessage.textContent = "damn, can't even remember your own username? (username wrong, or not registered)";
        usernameInput.style.borderColor = "red";
        errorMessage.style.display = "block";
        return;
        }
        if (usernameFound === null) {
            errorMessage.textContent = "Unable to check username. this is probably not your fault, please try again.";
            usernameInput.style.borderColor = "red";
            errorMessage.style.display = "block";
            return;
        } else {
            errorMessage.textContent = "Great! Username is correct:D";
            usernameValidity = true;
            usernameInput.style.borderColor = "#e3d8ca";
        }
    }

    if (!passwordCheck) {
        errorMessage.textContent = "Please enter a password";
        passwordInput.style.borderColor = "red";
        errorMessage.style.display = "block";
    } else {
        passwordValid = await isPasswordInDB(usernameCheck, passwordCheck);
        if (passwordValid === false) {
        errorMessage.textContent = "damn, can't even remember your own password? (password wrong)";
        passwordInput.style.borderColor = "red";
        errorMessage.style.display = "block";
        return;
        }
        if (passwordValid === null) {
            errorMessage.textContent = "Unable to check password. this is probably not your fault, please try again.";
            passwordInput.style.borderColor = "red";
            errorMessage.style.display = "block";
            return;
        } else {
            errorMessage.textContent = "Great! password is correct:D";
            passwordValidity = true;
            passwordInput.style.borderColor = "#e3d8ca";
        }
    }

    if (!usernameValidity || !passwordValidity) {
        return;
    }

    errorMessage.textContent = "";
    errorMessage.style.display = "none";
    console.log('checkValidity: submitting form');
    form.submit();
}

async function isUsernameInDB(username) {
    try {
        const response = await fetch(`includes/login_check_username.inc.php?username=${encodeURIComponent(username)}`);
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

        if (!data || typeof data.usernameFound !== 'boolean') {
            console.error('Username validation response invalid', data);
            return null;
        }

        return data.usernameFound === true;
    } catch (error) {
        console.error('Username validation request error', error);
        return null;
    }
}

async function isPasswordInDB(username, password) {
    try {
        const response = await fetch(`includes/login_check_password.inc.php?username=${encodeURIComponent(username)}&password=${encodeURIComponent(password)}`);
        const text = await response.text();

        if (!response.ok) {
            console.error('password validation request failed', response.status, text);
            return null;
        }

        let data;
        try {
            data = JSON.parse(text);
        } catch (parseError) {
            console.error('password validation response invalid JSON', parseError, text);
            return null;
        }

        if (!data || typeof data.passwordCorrect !== 'boolean') {
            console.error('password validation response invalid', data);
            return null;
        }

        return data.passwordCorrect === true;
    } catch (error) {
        console.error('password validation request error', error);
        return null;
    }
}



document.querySelector('form').addEventListener('submit', checkValidity);
