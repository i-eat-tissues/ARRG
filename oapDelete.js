const sleep = (ms) => new Promise((resolve) => setTimeout(resolve, ms));

async function confirmation(event) {
    event.preventDefault();
    let button = event.currentTarget.querySelector('.delete-post-button');
    if (button.textContent == 'click again to confirm (3)' || button.textContent == 'click again to confirm (2)' || button.textContent == 'click again to confirm (1)') {
        event.currentTarget.submit();
    }else if (button.textContent == 'delete post') {
        button.textContent = 'click again to confirm (3)'
        await sleep(1000);
        button.textContent = 'click again to confirm (2)'
        await sleep(1000);
        button.textContent = 'click again to confirm (1)'
        await sleep(1000);
        button.textContent = 'delete post'
    }else {
        button.textContent = 'an unexpected error occured. please try again later.'
    }
} 

document.querySelectorAll('.delete-post-form').forEach((form) => {
    form.addEventListener('submit', confirmation);
});