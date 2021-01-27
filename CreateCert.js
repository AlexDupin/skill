var cert = {
    crt_name: document.getElementById('id_crt_name'),
    crt_desc: document.getElementById('id_crt_desc'),
    crt_issuer: document.getElementById('id_crt_issuer'),
    submit: document.getElementById('btn-submit'),
}

cert.submit.addEventListener("click", () => {
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
    const requestData = `crt_name=${cert.crt_name.value}&crt_desc=${cert.crt_desc.value}&crt_issuer=${cert.crt_issuer.value}`;

    request.open("POST", "CreateCert.php");
    request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    request.send(requestData);
})

function handleResponse(responseObject){
    modal.style.display = 'none';
    alert.text.innerHTML = responseObject.msg;
    alert.show.style.display = 'block';
}