var training = {
    trg_name: document.getElementById('id_trg_name'),
    trg_desc: document.getElementById('id_trg_desc'),
    submit: document.getElementById('btn-submit'),
}

training.submit.addEventListener("click", () => {
    const request = new XMLHttpRequest();

    request.onload = () => {
        let responseObject = null;

        try {  
            responseObject = JSON.parse (request.responseText);
        }
        catch (error) {
            console.error('JSON could not be parsed');
            }
        if (responseObject){
            handleResponse(responseObject);
        }
    }
    const requestData = `trg_name=${training.trg_name.value}&trg_desc=${training.trg_desc.value}`;

    request.open("POST", "CreateTraining.php");
    request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    request.send(requestData);
})

function handleResponse(responseObject){
    modal.style.display = 'none';
    alert.text.innerHTML = responseObject.msg;
    alert.show.style.display = 'block';
}