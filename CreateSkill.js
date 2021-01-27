var skill = {
  name: document.getElementById('id_skill_name'),
  s_desc: document.getElementById('id_skill_sdesc'),
  l_desc: document.getElementById('id_skill_ldesc'),
  submit: document.getElementById('btn-submit_1')
};

skill.submit.addEventListener('click', () => {
  const request = new XMLHttpRequest();

  request.onload = () => {
    let responseObject = null;

    try {
      responseObject = JSON.parse(request.responseText);
    } catch (error) {
      console.error('Could not parse JSON');
    }
    if (responseObject) {
      handleResponse(responseObject);
    }
  };
  const requestData = `skill_name=${skill.name.value}&skill_sdesc=${skill.s_desc.value}&skill_ldesc=${skill.l_desc.value}`;

  request.open('POST', 'CreateSkill.php');
  request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  request.send(requestData);
});

function handleResponse(responseObject) {
  if (responseObject.ok) {
    modal.style.display = 'none';
    alert.relocate = 'SkillList.php';
    alert.text.innerHTML = responseObject.msg;
    alert.show.style.display = 'block';
  } else {
    modal.style.display = 'none';
    alert.refresh = false;
    alert.text.innerHTML = responseObject.msg;
    alert.show.style.display = 'block';
  }
}
