function checkPost(event) {
    event.preventDefault();
    let titleInput = document.getElementById('titleInput').value;
    let textInput = document.getElementById('textInput').value;
    let errorMessage = document.getElementById('errorMessage')
    if (!titleInput) {
        errorMessage.textContent = 'please enter a title';
        return;
    }else if (!textInput) {
        errorMessage.textContent = 'please enter a post';
        return;
    }
    event.currentTarget.submit();
} 

document.getElementById('oapPostForm').addEventListener('submit', checkPost);