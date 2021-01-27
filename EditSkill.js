var skill = {
	name: document.getElementById('id_skill_name'),
	s_desc: document.getElementById('id_skill_sdesc'),
	l_desc: document.getElementById('id_skill_ldesc'),
	submit: document.getElementById('btn-submit_2')
}

skill.submit.addEventListener("click", () => {
    const request = new XMLHttpRequest();

    request.onload = () => {
        let responseObject = null;
        
        try {
            responseObject = JSON.parse (request.responseText);
        } 
        catch (error) {
            console.error('Could not parse JSON');
            }
        if (responseObject) {
            handleResponse(responseObject);
        }
    }
    const requestData = `skill_name=${skill.name.value}&skill_sdesc=${skill.s_desc.value}&skill_ldesc=${skill.l_desc.value}`;

    request.open("POST", "EditSkill.php");
    request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    request.send(requestData);
})

function handleResponse (responseObject){
    modal.style.display = 'none';
    alert.text.innerHTML = responseObject.msg;
    alert.show.style.display = 'block';
}
