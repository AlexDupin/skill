var project = {
    proj_name: document.getElementById('id_proj_name'),
    proj_cust: document.getElementById('id_proj_cust'),
    proj_ind: document.getElementById('id_proj_industry'),
    proj_sdate: document.getElementById('id_proj_sdate'),
    proj_edate: document.getElementById('id_proj_edate'),
    proj_desc: document.getElementById('id_proj_desc'),
    submit: document.getElementById('btn-submit'),
}

project.submit.addEventListener("click", () => {
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
    const requestData = `proj_name=${project.proj_name.value}&proj_cust=${project.proj_cust.value}&proj_ind=${project.proj_ind.value}&proj_sdate=${project.proj_sdate.value}&proj_edate=${project.proj_edate.value}&proj_desc=${project.proj_desc.value}`;

    request.open("POST", "CreateProject.php");
    request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    request.send(requestData);
})

function handleResponse(responseObject){
    modal.style.display = 'none';
    alert.relocate = 'ProjectList.php';
    alert.text.innerHTML = responseObject.msg;
    alert.show.style.display = 'block';
}