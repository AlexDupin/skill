var employee = {
    firstname: document.getElementById('firstname'),
    lastname: document.getElementById('lastname'),
    organization: document.getElementById('organization'),
    entrydate: document.getElementById('entrydate'),
    exitdate: document.getElementById('exitdate'),
    pwd1: document.getElementById('password'),
    pwd2: document.getElementById('confirmpassword'),
    submit: document.getElementById('btn-submit')
}

employee.submit.addEventListener("click", () => {
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
//		window.top.location.reload();
    }
    const requestData = `firstname=${employee.firstname.value}&lastname=${employee.lastname.value}&entrydate=${employee.entrydate.value}&exitdate=${employee.exitdate.value}&organization=${employee.organization.value}&pwd1=${employee.pwd1.value}&pwd2=${employee.pwd2.value}`;

    request.open("POST", "EditEmployee.php");
    request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    request.send(requestData);
})

function handleResponse(responseObject) {
    modal_edit.style.display = 'none';
    alert.text.innerHTML = responseObject.msg;
    alert.show.style.display = 'block';
}