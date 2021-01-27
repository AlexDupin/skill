var skill = {
  name: document.getElementById('name'),
  s_desc: document.getElementById('s_desc'),
  desc: document.getElementById('desc')
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
  const requestData = `SkillName=${skill.name.value}&SkillSDesc=${skill.s_desc.value}&SkillDesc=${asset.desc.value}}`;

  request.open('POST', 'CreateSkill.php');
  request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  request.send(requestData);
});

function handleResponse(responseObject) {
  if (responseObject.ok) {
    modal.style.display = 'none';
    alert.relocate = 'SkillLink.php?%20id=A' + responseObject.tag;
    alert.text.innerHTML = responseObject.msg;
    alert.show.style.display = 'block';
  } else {
    modal.style.display = 'none';
    alert.refresh = false;
    alert.text.innerHTML = responseObject.msg;
    alert.show.style.display = 'block';
  }
}
