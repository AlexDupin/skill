const form = {
    username: document.getElementById("username"),
    password: document.getElementById("password"),
    submit: document.getElementById("btn-submit"),
    message: document.getElementById("msg"),
}

form.submit.addEventListener('click',() => {
    const request = new XMLHttpRequest();

    request.onload = () => {
        let responseValue = request.responseText;

        handleResponse(responseValue)
    }

    const requestData = `username=${form.username.value}&password=${form.password.value}`;

    request.open('POST',  'Login.php');
    request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    request.send(requestData);
});

function handleResponse(responseValue){
    if (responseValue){
        location.href = 'dashboard.php';
    }
    else{
        form.message.style.display = "block";
    }
}
