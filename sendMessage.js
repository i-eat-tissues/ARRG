const form = document.querySelector('#messageInput');
const chatMessages = document.querySelector('#chatMessages');

function addMessage(username, sentAt, text) { //creates a new message in the same format as the one in the foreach
    const message = document.createElement('div');
    message.className = 'message';

    const header = document.createElement('div');
    header.className = 'chat-message-header';

    const name = document.createElement('p');
    name.className = 'chat-username';
    name.textContent = username;

    const time = document.createElement('p');
    time.className = 'chat-timestamp';
    time.textContent = sentAt;

    header.append(name, time);

    const body = document.createElement('p');
    body.className = 'chat-message';
    body.textContent = text;

    message.append(header, body);
    chatMessages.append(message);
    chatMessages.scrollTop = chatMessages.scrollHeight;
}


form.addEventListener('submit', async (event) => { //listens to when the form was submitted
    event.preventDefault(); //prevents the browser from redirecting to sendMessage.inc.php (aka refreshing)

    const input = form.querySelector('[name="message"]'); // input of the message
    const formData = new FormData(form); //new formdata which we will use to send to the database

    try {
        const response = await fetch('includes/sendMessage.inc.php', { //sends to sendMessage.inc.php with json i think maybe and then awaits its response
            method: 'POST',
            body: formData
        });
        const result = await response.json();

        if (!response.ok || !result.success) {
            console.error('message not sent:', result.error);
            return;
        }

        addMessage(result.username, result.sent_at, result.message); //calls the addMessage() function to create a new message on the page without refreshing
        input.value = ''; //sets the input to nothing
        increaseCounter(); //refreshes the counter because the counter doesn't count linearly; it counts based on the current length of the value in the textarea
    } catch (error) {
        console.error('error sending message:', error);
    }
});

const textInput = document.querySelector('#textInput'); //selected the text input

textInput.addEventListener('keydown', (event) => {
    if (event.key === 'Enter' && !event.shiftKey && !event.isComposing) { //event.isComposing prevents people typing in chinese from getting their not finished character that is still being composed from being sent
        event.preventDefault();    
        form.requestSubmit();    
    }
});

